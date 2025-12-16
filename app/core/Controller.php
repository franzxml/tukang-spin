<?php
/**
 * Base Controller
 *
 * Loads models and views.
 *
 * @package Genpedia
 * @author  franzxml
 */
class Controller
{
    /**
     * Load a model.
     *
     * @param string $model The model name.
     * @return object Instantiated model.
     */
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Load a view.
     *
     * @param string $view The view file name.
     * @param array $data Data to pass to view.
     */
    public function view($view, $data = [])
    {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}