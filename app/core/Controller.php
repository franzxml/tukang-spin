<?php
/**
 * Base Controller.
 * Handles view loading and data passing.
 */

namespace App\Core;

class Controller
{
    /**
     * Load a view file and pass data to it.
     *
     * @param string $view The view file path (relative to views folder).
     * @param array $data Associative array of data to make available in the view.
     * @return void
     */
    public function view(string $view, array $data = []): void
    {
        // Extract array keys to variables
        extract($data);

        // dirname(__DIR__) is 'app', so this points to 'app/views/'
        $viewPath = dirname(__DIR__) . '/views/' . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            // Simple error handling for development
            die("View '{$view}' not found at {$viewPath}");
        }
    }
}