<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// The Laravel application lives in harbour-manager/
$appDir = __DIR__ . '/../harbour-manager';

// We will rely on Vercel Environment Variables or the committed .env.production

// SQLite: create the database file in /tmp if it doesn't exist
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Maintenance mode check
if (file_exists($maintenance = $appDir . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Use the vendor/ installed here
$autoloader = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloader)) {
    die("Autoloader not found at: " . $autoloader);
}
require $autoloader;

// Change working directory so Laravel resolves relative paths correctly
chdir($appDir);

// Bootstrap Laravel from harbour-manager/bootstrap/app.php
/** @var Application $app */
$app = require_once $appDir . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
