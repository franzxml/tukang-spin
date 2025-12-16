<?php
/**
 * Search Controller
 * Handles search queries.
 * @package Genpedia
 */
class Search extends Controller
{
    public function index()
    {
        $term = isset($_GET['q']) ? trim($_GET['q']) : '';
        
        $charModel = $this->model('Character');
        
        if (!empty($term)) {
            $characters = $charModel->searchCharacters($term);
            $title = "Results for: " . htmlspecialchars($term);
        } else {
            $characters = $charModel->getCharacters();
            $title = "All Characters";
        }

        $data = [
            'title' => $title,
            'characters' => $characters
        ];

        $this->view('pages/index', $data);
    }
}