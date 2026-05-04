<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// The Laravel application lives in harbour-manager/
$appDir = realpath(__DIR__ . '/../harbour-manager');

// SQLite: create the database file in /tmp if it doesn't exist
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Use the vendor/ installed here
$autoloader = __DIR__ . '/vendor/autoload.php';
if (!file_exists($autoloader)) {
    die("Autoloader not found at: " . $autoloader);
}
require $autoloader;

// Change working directory
chdir($appDir);

// Bootstrap Laravel
/** @var Application $app */
$app = require_once $appDir . '/bootstrap/app.php';

// CRITICAL: Set the storage path to /tmp for Vercel (read-only filesystem fix)
$app->useStoragePath('/tmp');

$app->handleRequest(Request::capture());
