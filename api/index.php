<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// The Laravel application lives in harbour-manager/
$appDir = __DIR__ . '/../harbour-manager';

// Maintenance mode check
if (file_exists($maintenance = $appDir . '/storage/framework/maintenance.php')) {
    require $maintenance;
}

// Use the vendor/ installed HERE (api/vendor/) by vercel-php's composer install
require __DIR__ . '/vendor/autoload.php';

// Change working directory so Laravel resolves relative paths correctly
chdir($appDir);

// Bootstrap Laravel from harbour-manager/bootstrap/app.php
/** @var Application $app */
$app = require_once $appDir . '/bootstrap/app.php';

$app->handleRequest(Request::capture());
