<?php

/**
 * Main Entry Point
 *
 * This file bootstraps the application by requiring the initialization file
 * and instantiating the main App class.
 */

// Initialize the session
if (!session_id()) {
    session_start();
}

// Load the bootstrapper
require_once '../app/init.php';

// Instantiate the App (Router)
$app = new App();