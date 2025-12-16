<?php
/**
 * Search Controller
 * @package Genpedia
 */
class Search extends Controller
{
    public function index()
    {
        $term = isset($_GET['q']) ? trim($_GET['q']) : '';
        // Updated path
        $charModel = $this->model('characters/Character');
        
        if (!empty($term)) {
            $characters = $charModel->searchCharacters($term);
            $title = "Results for: " . htmlspecialchars($term);
        } else {
            $characters = $charModel->getCharacters();
            $title = "All Characters";
        }

        $this->view('pages/index', ['title' => $title, 'characters' => $characters]);
    }
}