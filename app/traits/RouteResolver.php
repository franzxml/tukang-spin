<?php
/**
 * Route Resolver Trait.
 * Locates Controllers and Methods.
 */

namespace App\Traits;

trait RouteResolver
{
    /**
     * Resolve the Controller class.
     *
     * @param array &$url The URL segments.
     * @return void
     */
    protected function resolveController(array &$url): void
    {
        if (isset($url[0])) {
            $ctrlName = ucfirst($url[0]);
            $path = dirname(__DIR__) . '/controllers/' . $ctrlName . '.php';
            
            if (file_exists($path)) {
                $this->controller = $ctrlName;
                unset($url[0]);
            }
        }

        require_once dirname(__DIR__) . '/controllers/' . $this->controller . '.php';
        $class = '\\App\\Controllers\\' . $this->controller;
        $this->controller = new $class;
    }

    /**
     * Resolve the Method name.
     *
     * @param array &$url The URL segments.
     * @return void
     */
    protected function resolveMethod(array &$url): void
    {
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
    }
}