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
        $this->loadController();
        $controllerInstance = new $this->controller();
        call_user_func_array([$controllerInstance, $this->method], $this->params);
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