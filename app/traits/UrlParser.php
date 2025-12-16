<?php
/**
 * URL Parser Trait.
 * Handles fetching and sanitizing the URL.
 */

namespace App\Traits;

trait UrlParser
{
    /**
     * Parse the URL from $_GET.
     *
     * @return array
     */
    protected function parseUrl(): array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $sanitized = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $sanitized);
        }
        return [];
    }
}