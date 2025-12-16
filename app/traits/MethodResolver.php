<?php
/**
 * Method Resolver Trait.
 */

namespace App\Traits;

trait MethodResolver
{
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