<?php
/**
 * Bootstrap File
 *
 * Loads configuration and core libraries.
 *
 * @package Genpedia
 * @author  franzxml
 */

// Load Config
require_once 'config/config.php';

// Load Database
require_once 'config/Database.php';

// Load Core Libraries
require_once 'app/core/UrlParser.php';
require_once 'app/core/Controller.php';
require_once 'app/core/Core.php';