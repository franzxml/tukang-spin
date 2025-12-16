<?php
/**
 * Global Configuration Constants.
 *
 * Defines database connection parameters and base application paths.
 *
 * @package Config
 */

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'genpedia');

// Application Root
// Fix: Append '/app' so APPROOT points to the actual app directory
define('APPROOT', dirname(dirname(__FILE__)) . '/app');

// URL Root (Dynamic)
define('URLROOT', 'http://genpedia.test');

// Site Name
define('SITENAME', 'Genpedia');