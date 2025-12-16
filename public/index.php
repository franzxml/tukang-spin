<?php
/**
 * Main Entry Point.
 * Bootstraps the application.
 */

// Load the Autoloader
require_once __DIR__ . '/../app/core/Autoloader.php';

// Register the Autoloader
use App\Core\Autoloader;
Autoloader::register();

// Test the flow
use Config\Database;

try {
    $db = Database::connect();
    echo "<h1>Genpedia System Online</h1>";
    echo "<p>Database Connection: <strong>Successful</strong></p>";
} catch (\Exception $e) {
    echo "<h1>System Error</h1>";
    echo $e->getMessage();
}