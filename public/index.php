<?php
/**
 * Entry Point.
 *
 * Bootstraps the application.
 *
 * @package Public
 */

// Load Config
require_once '../config/config.php';

// Load Core Libraries
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';

// Initialize the Core App
$init = new App();