<?php
/**
 * Core Application Class.
 * Manages URL routing and controller instantiation.
 *
 * @package App\Core
 */
class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    /**
     * Initialize the application.
     */
    public function __construct() {
        $url = $this->parseUrl();

        // Check if controller exists
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Check if method exists
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Get params
        $this->params = $url ? array_values($url) : [];

        // Call callback with array of params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parse the URL parameter.
     * @return array
     */
    public function parseUrl() {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return ['Home']; // Default fallback
    }
}