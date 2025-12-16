<?php
/**
 * Characters Controller
 * Handles character CRUD actions.
 * @package Genpedia
 */
class Characters extends Controller
{
    private $charModel;

    public function __construct()
    {
        $this->charModel = $this->model('Character');
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'element' => trim($_POST['element']),
                'weapon' => trim($_POST['weapon']),
                'rarity' => trim($_POST['rarity']),
                'region' => trim($_POST['region']),
                'description' => trim($_POST['description'])
            ];

            if ($this->charModel->add($data)) {
                header('Location: ' . URLROOT);
            } else {
                die('Something went wrong');
            }
        } else {
            $data = ['title' => 'Add Character'];
            $this->view('characters/add', $data);
        }
    }
}