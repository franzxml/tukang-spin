<?php
/**
 * Core Application Router
 * 
 * @package Genpedia
 * @author franzxml
 */

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    /**
     * Initialize and route the application
     */
    public function __construct()
    {
        $url = $this->parseUrl();
        $this->routeRequest($url);
    }

    /**
     * Parse URL from request
     * 
     * @return array|null
     */
    private function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return null;
    }

    /**
     * Route request to controller
     * 
     * @param array|null $url
     * @return void
     */
    private function routeRequest($url)
    {
        if ($url && isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerPath = BASE_PATH . '/app/controllers/' . $controllerName . '.php';
            
            if (file_exists($controllerPath)) {
                $this->controller = $controllerName;
                
                if (isset($url[1])) {
                    $this->method = $url[1];
                }
            }
        }
        
        $this->loadController();
        $controllerInstance = new $this->controller();
        
        if (method_exists($controllerInstance, $this->method)) {
            call_user_func_array([$controllerInstance, $this->method], $this->params);
        } else {
            call_user_func_array([$controllerInstance, 'index'], $this->params);
        }
    }

    /**
     * Load controller
     * 
     * @return void
     */
    private function loadController()
    {
        require_once BASE_PATH . '/app/controllers/' . $this->controller . '.php';
    }
}