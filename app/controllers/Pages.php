<?php
/**
 * Pages Controller
 *
 * Handles default pages.
 *
 * @package Genpedia
 * @author  franzxml
 */
class Pages extends Controller
{
    private $charModel;

    /**
     * Constructor
     * Loads the Character model.
     */
    public function __construct()
    {
        $this->charModel = $this->model('Character');
    }

    /**
     * Index Method
     * Loads homepage with character list.
     */
    public function index()
    {
        $characters = $this->charModel->getCharacters();
        
        $data = [
            'title' => 'Genpedia',
            'characters' => $characters
        ];

        $this->view('pages/index', $data);
    }
}