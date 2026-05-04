<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Laravel app root
$appDir = realpath(__DIR__ . '/../harbour-manager');

// SQLite database in /tmp (only writable location on Vercel)
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Pre-create ALL directories that Laravel needs to write to
// (Vercel's filesystem is read-only everywhere except /tmp)
$tmpDirs = [
    '/tmp/storage',
    '/tmp/storage/app',
    '/tmp/storage/app/public',
    '/tmp/storage/framework',
    '/tmp/storage/framework/cache',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/framework/views',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
];
foreach ($tmpDirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Require the autoloader from api/vendor/ (installed by vercel-php)
$autoloader = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloader)) {
    die('FATAL: Autoloader not found at ' . $autoloader . '. Vendor directory is missing.');
}
require $autoloader;

// Set working directory to Laravel app root
chdir($appDir);

// Bootstrap Laravel
/** @var Application $app */
$app = require_once $appDir . '/bootstrap/app.php';

// Override storage and bootstrap/cache paths to /tmp
$app->useStoragePath('/tmp/storage');
$app->instance('path.storage',          '/tmp/storage');
$app->instance('path.bootstrap.cache',  '/tmp/bootstrap/cache');

$app->handleRequest(Request::capture());
