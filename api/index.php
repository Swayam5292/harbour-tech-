<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Redirect index.php to root
if (strpos($_SERVER['REQUEST_URI'], '/index.php') !== false) {
    header("Location: /", true, 301);
    exit;
}

// Path setup
$baseDir = dirname(__DIR__); // Root folder
$appDir = $baseDir . '/harbour-manager';

// Use a writable temp directory. On Vercel this resolves to /tmp.
$tmpBase = is_writable('/tmp') ? '/tmp' : rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);

// SQLite database in temp directory (writable location on Vercel)
$dbPath = $tmpBase . '/database.sqlite';
$runMigrations = false;
if (!file_exists($dbPath) || filesize($dbPath) === 0) {
    if (!file_exists($dbPath)) {
        touch($dbPath);
    }
    $runMigrations = true;
}

// Enforce writable runtime defaults for serverless environments.
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=' . $dbPath);
putenv('SESSION_DRIVER=cookie');
putenv('CACHE_STORE=array');
putenv('QUEUE_CONNECTION=sync');
putenv('APP_KEY=base64:Jcfaxs/O3z269myM/CqTWJsusALqDUQqRKfYtSBvF+o=');
putenv('LOG_CHANNEL=stderr');
putenv('APP_DEBUG=true');

// Pre-create ALL directories that Laravel needs to write to
$tmpDirs = [
    $tmpBase . '/storage',
    $tmpBase . '/storage/app',
    $tmpBase . '/storage/app/public',
    $tmpBase . '/storage/framework',
    $tmpBase . '/storage/framework/cache',
    $tmpBase . '/storage/framework/cache/data',
    $tmpBase . '/storage/framework/sessions',
    $tmpBase . '/storage/framework/views',
    $tmpBase . '/storage/logs',
    $tmpBase . '/bootstrap/cache',
];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
        // Fallback or skip if fails
    }
}

// Look for the autoloader in the ROOT directory (Vercel installs it there)
$autoloader = $baseDir . '/vendor/autoload.php';

// Fallback to local vendor or harbour-manager vendor
if (!file_exists($autoloader)) {
    $autoloader = $appDir . '/vendor/autoload.php';
}
if (!file_exists($autoloader)) {
    $autoloader = __DIR__ . '/vendor/autoload.php';
}

if (!file_exists($autoloader)) {
    die('FATAL: Autoloader not found at: ' . $autoloader . '. Please ensure composer install has run in the root directory.');
}

require $autoloader;

// Set working directory to Laravel app root for artisan/config etc.
chdir($appDir);

// Bootstrap Laravel
/** @var Application $app */
$app = require_once $appDir . '/bootstrap/app.php';

// Mirror providers list into writable bootstrap dir and switch bootstrap path.
$runtimeBootstrapDir = $tmpBase . '/bootstrap';
$providersSource = $appDir . '/bootstrap/providers.php';
$providersTarget = $runtimeBootstrapDir . '/providers.php';
if (!file_exists($providersTarget) && file_exists($providersSource)) {
    copy($providersSource, $providersTarget);
}
$app->useBootstrapPath($runtimeBootstrapDir);

// Override storage path to writable temp storage.
$app->useStoragePath($tmpBase . '/storage');
$app->instance('path.storage', $tmpBase . '/storage');

try {
    $schema = $app['db']->connection()->getSchemaBuilder();
    if ($runMigrations || !$schema->hasTable('projects')) {
        $app->make('Illuminate\Contracts\Console\Kernel')->call('migrate', ['--force' => true]);
    }
} catch (\Exception $e) {
    // Fail gracefully
}

$app->handleRequest(Request::capture());
