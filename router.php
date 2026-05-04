<?php
// Router for PHP built-in server
// Matches Vercel's behavior: maps root to api/index.php
$uri = $_SERVER['REQUEST_URI'];
$path = parse_url($uri, PHP_URL_PATH);

// If the path is just "/", or index.php/html, look in api/index.php
if ($path === '/' || $path === '/index.html' || $path === '/index.php') {
    $file = __DIR__ . '/api/index.php';
} else {
    $file = __DIR__ . $path;
}

// Fallback for other PHP files in api/
if (pathinfo($path, PATHINFO_EXTENSION) === 'php' && !file_exists($file)) {
    $file = __DIR__ . '/api' . $path;
}

// Process PHP files
if (pathinfo($file, PATHINFO_EXTENSION) === 'php' && file_exists($file)) {
    include $file;
    return true;
}

// Let the built-in server handle everything else
return false;
