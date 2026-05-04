<?php
/**
 * Pre-generate bootstrap/cache files to bypass OneDrive is_writable() issue.
 * Run once: php generate_cache.php
 */

$basePath = __DIR__;
$vendorPath = $basePath . '/vendor';
$cachePath = $basePath . '/bootstrap/cache';

// ---- Generate packages.php ----
$installed = require $vendorPath . '/composer/installed.php';
$packages = [];

foreach ($installed['versions'] as $name => $package) {
    $extra = $package['extra']['laravel'] ?? null;
    if (!$extra) continue;

    $packageData = [];
    if (isset($extra['providers'])) {
        $packageData['providers'] = $extra['providers'];
    }
    if (isset($extra['aliases'])) {
        $packageData['aliases'] = $extra['aliases'];
    }
    if ($packageData) {
        $packages[$name] = $packageData;
    }
}

$manifest = [
    'providers' => [],
    'eager' => [],
    'deferred' => [],
    'when' => [],
];

foreach ($packages as $package) {
    if (isset($package['providers'])) {
        foreach ($package['providers'] as $provider) {
            $manifest['providers'][] = $provider;
            $manifest['eager'][] = $provider;
        }
    }
}

$content = "<?php\nreturn " . var_export($manifest, true) . ";\n";
file_put_contents($cachePath . '/packages.php', $content);
echo "packages.php written.\n";

// ---- Generate services.php ----
$services = "<?php\nreturn " . var_export(['providers' => [], 'eager' => [], 'deferred' => []], true) . ";\n";
file_put_contents($cachePath . '/services.php', $services);
echo "services.php written.\n";

echo "Done. You can now run artisan commands.\n";
