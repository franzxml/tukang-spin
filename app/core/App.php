<?php
/**
 * Core Application Router
 * 
 * @package Genpedia
 * @author franzxml
 */

class App
{
    /**
     * Initialize and route the application
     */
    public function __construct()
    {
        $this->loadController();
    }

    /**
     * Load the appropriate controller
     * 
     * @return void
     */
    private function loadController()
    {
        require_once BASE_PATH . '/app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
    }
}