<?php
/**
 * Pages Controller
 * @package Genpedia
 */
class Pages extends Controller
{
    private $charModel;

    public function __construct()
    {
        // Updated path
        $this->charModel = $this->model('characters/Character');
    }

    public function index()
    {
        $characters = $this->charModel->getCharacters();
        $data = ['title' => 'Genpedia', 'characters' => $characters];
        $this->view('pages/index', $data);
    }
}