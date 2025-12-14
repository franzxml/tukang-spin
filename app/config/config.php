<?php

/**
 * Configuration Constants
 *
 * This file contains the global configuration settings for the Genpedia application,
 * including database credentials and the base URL.
 */

// Base URL of the application (Adjust based on your local folder name)
// Ensure there is NO trailing slash at the end
define('BASEURL', 'http://localhost/genpedia/public');

// Database Configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // Leave empty if using default XAMPP/Laragon
define('DB_NAME', 'genpedia');

// Application Metadata
define('APP_NAME', 'Genpedia');