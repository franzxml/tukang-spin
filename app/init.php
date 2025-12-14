<?php

/**
 * Bootstrapper file.
 * Require core files needed to run the application.
 *
 * Order is important:
 * 1. Config (Constants)
 * 2. Core Libraries (App, Controller, Database, Flasher)
 */

require_once 'config/config.php';
require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'core/Database.php';
require_once 'core/Flasher.php';