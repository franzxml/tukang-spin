<?php
/**
 * Base Controller Class
 * 
 * @package Genpedia
 * @author franzxml
 */

class Controller
{
    /**
     * Load a view file
     * 
     * @param string $view View file name
     * @param array $data Data to pass to view
     * @return void
     */
    protected function view($view, $data = [])
    {
        $viewPath = BASE_PATH . '/app/views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        }
    }
}