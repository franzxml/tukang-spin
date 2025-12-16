<?php
/**
 * Controller Resolver Trait.
 */

namespace App\Traits;

trait ControllerResolver
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
            $path = dirname(__DIR__) . '/Controllers/' . $ctrlName . '.php';
            
            if (file_exists($path)) {
                $this->controller = $ctrlName;
                unset($url[0]);
            }
        }

        require_once dirname(__DIR__) . '/Controllers/' . $this->controller . '.php';
        $class = '\\App\\Controllers\\' . $this->controller;
        $this->controller = new $class;
    }
}