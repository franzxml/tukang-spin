<?php
/**
 * Entry Point.
 *
 * Bootstraps the application by loading config and initializing Core.
 *
 * @package Public
 */

require_once '../config/config.php';
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';

// Initialize the Core App
$init = new App();