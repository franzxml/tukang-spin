<?php
/**
 * Main Entry Point.
 * Bootstraps the application and triggers the Router.
 */

// Load the Autoloader (Updated path to Capitalized 'Core')
require_once __DIR__ . '/../app/Core/Autoloader.php';

// Register the Autoloader
use App\Core\Autoloader;

Autoloader::register();

// Trigger the Router
use App\Core\Router;

$app = new Router();