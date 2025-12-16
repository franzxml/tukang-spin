<?php
/**
 * URL Parser Class
 *
 * Handles fetching and sanitizing the URL from $_GET.
 *
 * @package Genpedia
 * @author  franzxml
 */
class UrlParser
{
    /**
     * Get and sanitize the URL.
     *
     * @return array|null Returns URL segments or null.
     */
    public static function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return null;
    }
}