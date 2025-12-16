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
            // Append 'Controller' to the URL segment
            $ctrlName = ucfirst($url[0]) . 'Controller';
            // Updated path to use Capitalized 'Controllers'
            $path = dirname(__DIR__) . '/Controllers/' . $ctrlName . '.php';
            
            if (file_exists($path)) {
                $this->controller = $ctrlName;
                unset($url[0]);
            }
        }

        // Updated require path
        require_once dirname(__DIR__) . '/Controllers/' . $this->controller . '.php';
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