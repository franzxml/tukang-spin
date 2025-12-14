<?php

/**
 * Class App
 *
 * The main router class for the MVC framework.
 * It parses the URL and dispatches the request to the appropriate controller and method.
 *
 * @package App\Core
 */
class App
{
    /** @var string $controller The default controller to load. */
    protected string $controller = 'Home';

    /** @var string $method The default method to execute. */
    protected string $method = 'index';

    /** @var array $params The parameters passed in the URL. */
    protected array $params = [];

    /**
     * App constructor.
     * Initializes the routing process.
     */
    public function __construct()
    {
        $url = $this->parseUrl();

        // 1. Check for Controller
        if (isset($url[0]) && file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->controller = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Check for Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Handle Parameters
        $this->params = $url ? array_values($url) : [];

        // Dispatch logic
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * Parses the current URL into an array segments.
     *
     * @return array|null Returns the URL segments or null if index is accessed directly.
     */
    public function parseUrl(): ?array
    {
        if (isset($_GET['url'])) {
            // Trim trailing slash and sanitize URL
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return null;
    }
}