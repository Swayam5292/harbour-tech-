<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Laravel app root
$appDir = realpath(__DIR__ . '/../harbour-manager');

// Use a writable temp directory. On Vercel this resolves to /tmp.
$tmpBase = is_writable('/tmp') ? '/tmp' : rtrim(sys_get_temp_dir(), DIRECTORY_SEPARATOR);

// SQLite database in temp directory (writable location on Vercel)
$dbPath = $tmpBase . '/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Enforce writable runtime defaults for serverless environments.
putenv('DB_CONNECTION=sqlite');
putenv('DB_DATABASE=' . $dbPath);
putenv('SESSION_DRIVER=file');
putenv('CACHE_STORE=file');
putenv('QUEUE_CONNECTION=sync');
putenv('LOG_CHANNEL=stderr');

// Pre-create ALL directories that Laravel needs to write to
// (Vercel's filesystem is read-only everywhere except /tmp)
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
        die('FATAL: Unable to create runtime directory: ' . $dir);
    }
}

// Prefer Laravel app autoloader; fallback to API autoloader if needed.
$autoloader = $appDir . '/vendor/autoload.php';
if (!file_exists($autoloader)) {
    $autoloader = __DIR__ . '/vendor/autoload.php';
}
if (!file_exists($autoloader)) {
    die('FATAL: Autoloader not found at ' . $autoloader . '. Vendor directory is missing.');
}
$loader = require $autoloader;

// Ensure app namespace autoloading works even when using api/vendor autoloader.
if ($loader instanceof Composer\Autoload\ClassLoader) {
    $loader->addPsr4('App\\', $appDir . '/app');
    $loader->addPsr4('Database\\Factories\\', $appDir . '/database/factories');
    $loader->addPsr4('Database\\Seeders\\', $appDir . '/database/seeders');
}

// Set working directory to Laravel app root
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
$app->instance('path.storage',          $tmpBase . '/storage');

$app->handleRequest(Request::capture());
