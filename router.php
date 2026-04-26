<?php
// Router for PHP built-in server
// Makes .html files get processed as PHP
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$file = __DIR__ . $path;

// If the path is just "/", look for index.php in api folder
if ($path === '/' || $path === '/index.php') {
    $file = __DIR__ . '/api/index.php';
} else {
    $file = __DIR__ . $path;
}

// If it's a PHP file and doesn't exist at root, check api folder
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
