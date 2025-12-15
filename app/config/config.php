<?php

/**
 * Configuration Constants
 *
 * This file contains the global configuration settings for the Genpedia application,
 * including database credentials, base URL, and application metadata.
 *
 * @package App\Config
 */

/**
 * Base URL of the application.
 * * Set to the Virtual Host domain.
 * Ensure your web server's Document Root points to the /public directory.
 * Do NOT include a trailing slash.
 *
 * @var string
 */
define('BASEURL', 'http://genpedia.test');

/**
 * Database Host
 *
 * The hostname of the database server (usually localhost).
 *
 * @var string
 */
define('DB_HOST', 'localhost');

/**
 * Database Username
 *
 * The username used to connect to the database.
 *
 * @var string
 */
define('DB_USER', 'root');

/**
 * Database Password
 *
 * The password used to connect to the database.
 * Leave empty if using default XAMPP/Laragon configuration.
 *
 * @var string
 */
define('DB_PASS', '');

/**
 * Database Name
 *
 * The specific name of the database schema to select.
 *
 * @var string
 */
define('DB_NAME', 'genpedia');

/**
 * Application Name
 *
 * The global display name of the application.
 *
 * @var string
 */
define('APP_NAME', 'Genpedia');