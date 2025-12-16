<?php
/**
 * Main Entry Point.
 * Bootstraps the application and triggers the Router.
 */

// Load the Autoloader
require_once __DIR__ . '/../app/core/Autoloader.php';

// Register the Autoloader
use App\Core\Autoloader;

Autoloader::register();

// Trigger the Router
use App\Core\Router;

$app = new Router();