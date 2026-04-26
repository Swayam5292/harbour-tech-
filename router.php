<?php
// Router for PHP built-in server
// Makes .html files get processed as PHP
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);
$file = __DIR__ . $path;

// If it's an .html file, process it as PHP
if (pathinfo($path, PATHINFO_EXTENSION) === 'html' && file_exists($file)) {
    include $file;
    return true;
}

// Let the built-in server handle everything else (css, js, images, etc.)
return false;
