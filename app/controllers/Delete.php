<?php
/**
 * Delete Controller
 * Handles character deletion requests.
 * @package Genpedia
 */
class Delete extends Controller
{
    /**
     * Execute Delete
     * * @param int $id ID of character to delete
     */
    public function index($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $remover = $this->model('CharacterRemover');

            if ($remover->delete($id)) {
                header('Location: ' . URLROOT);
            } else {
                die('Something went wrong');
            }
        } else {
            // Prevent GET access to delete
            header('Location: ' . URLROOT);
        }
    }
}