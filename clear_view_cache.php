<?php

// Include the autoloader and bootstrap the application
require __DIR__.'/bootstrap/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

// Boot up the application and handle the request
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

// Clear various caches
try {
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('clear-compiled');
    Artisan::call('optimize:clear');

    echo 'All caches cleared successfully!';
} catch (\Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
