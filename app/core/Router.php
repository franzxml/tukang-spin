<?php
/**
 * Core Router.
 * Composes traits to dispatch requests.
 */

namespace App\Core;

use App\Traits\UrlParser;
use App\Traits\RouteResolver;

class Router
{
    use UrlParser;
    use RouteResolver;

    protected mixed $controller = 'HomeController';
    protected string $method = 'index';
    protected array $params = [];

    /**
     * Initialize Router.
     */
    public function __construct()
    {
        $url = $this->parseUrl();

        $this->resolveController($url);
        $this->resolveMethod($url);

        $this->params = $url ? array_values($url) : [];

        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
    }
}