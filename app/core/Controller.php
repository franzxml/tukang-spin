<?php

/**
 * Class Controller
 *
 * The base controller class. All other controllers must extend this class.
 * Provides methods to load views and models.
 *
 * @package App\Core
 */
class Controller
{
    /**
     * Loads a view file.
     *
     * @param string $view The name of the view file (path relative to app/views/).
     * @param array $data Data to be passed to the view.
     * @return void
     */
    public function view(string $view, array $data = []): void
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // Fallback for debugging purposes
            die("View does not exist.");
        }
    }

    /**
     * Loads a model class.
     *
     * @param string $model The name of the model class.
     * @return object An instance of the requested model.
     */
    public function model(string $model): object
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
}