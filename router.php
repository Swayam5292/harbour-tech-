<?php
// Router for PHP built-in server
// Makes .php files the primary entry point
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// If the path is just "/", look for index.php first
if ($path === '/' || $path === '/index.html') {
    $file = __DIR__ . '/index.php';
} else {
    $file = __DIR__ . $path;
}

// If it's a PHP file and doesn't exist, let it fail or check api
if (pathinfo($path, PATHINFO_EXTENSION) === 'php' && !file_exists($file)) {
    $file = __DIR__ . '/api' . $path;
}

// Process PHP files
if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && file_exists($file)) {
    include $file;
    return true;
}

// Let the built-in server handle everything else (css, js, images, etc.)
return false;
