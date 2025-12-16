<?php
/**
 * Base Controller Class.
 *
 * Loads models and views.
 *
 * @package App\Core
 */
class Controller {
    /**
     * Load a model.
     *
     * @param string $model The model name.
     * @return object Instantiated model.
     */
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Load a view.
     *
     * @param string $view The view file name.
     * @param array $data Data to pass to the view.
     * @return void
     */
    public function view($view, $data = []) {
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}