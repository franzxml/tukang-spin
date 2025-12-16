<?php
/**
 * Application Configuration
 *
 * Defines global constants for database connection
 * and application settings.
 *
 * @package Genpedia
 * @author  franzxml
 */

// Database Host
define('DB_HOST', 'localhost');

// Database User
define('DB_USER', 'root');

// Database Password
define('DB_PASS', '');

// Database Name
define('DB_NAME', 'genpedia');

// App Root URL (Useful for assets later)
define('APPROOT', dirname(dirname(__FILE__)));
define('URLROOT', 'http://localhost/genpedia');