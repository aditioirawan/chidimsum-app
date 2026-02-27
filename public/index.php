<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// --- TAMBAHAN: Bypass Permission Denied di Render ---
// Memaksa view cache dan session tidak menulis ke folder storage yang dikunci
if (is_writable('/tmp')) {
    putenv('VIEW_COMPILED_PATH=/tmp');
}
// ----------------------------------------------------

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());