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
        $data['currentPage'] = $this->getCurrentPage();
        $viewPath = BASE_PATH . '/app/views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            extract($data);
            require_once $viewPath;
        }
    }

    /**
     * Get current page name
     * 
     * @return string
     */
    private function getCurrentPage()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $path = trim($path, '/');
        return empty($path) ? 'home' : explode('/', $path)[0];
    }
}