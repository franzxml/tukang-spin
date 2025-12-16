<?php
/**
 * Pages Controller
 *
 * Handles the default pages of the application.
 *
 * @package Genpedia
 * @author  franzxml
 */
class Pages extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // Constructor logic if needed
    }

    /**
     * Index Method
     * Loads the homepage.
     */
    public function index()
    {
        $data = [
            'title' => 'Genpedia',
            'description' => 'Private Genshin Impact Database'
        ];

        $this->view('pages/index', $data);
    }
}