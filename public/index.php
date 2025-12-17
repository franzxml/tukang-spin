<?php
/**
 * Genpedia Application Entry Point
 * 
 * @package Genpedia
 * @author franzxml
 */

// Define base path
define('BASE_PATH', dirname(__DIR__));

// Require configuration
require_once BASE_PATH . '/app/config/config.php';

// Require core files
require_once BASE_PATH . '/app/core/App.php';
require_once BASE_PATH . '/app/core/Controller.php';

// Initialize application
$app = new App();