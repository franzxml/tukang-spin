<?php
/**
 * Core Router.
 * Routes URLs to Controllers and Methods.
 */

namespace App\Core;

class Router
{
    protected mixed $controller = 'HomeController';
    protected string $method = 'index';
    protected array $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // Check for Controller
        if (isset($url[0])) {
            $ctrlName = ucfirst($url[0]);
            if (file_exists(dirname(__DIR__) . '/controllers/' . $ctrlName . '.php')) {
                $this->controller = $ctrlName;
                unset($url[0]);
            }
        }

        // Instantiate Controller
        require_once dirname(__DIR__) . '/controllers/' . $this->controller . '.php';
        $class = '\\App\\Controllers\\' . $this->controller;
        $this->controller = new $class;

        // Check for Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Process Params & Dispatch
        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            return explode('/', filter_var($url, FILTER_SANITIZE_URL));
        }
        return [];
    }
}