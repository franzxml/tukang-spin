<?php
/**
 * Edit Controller
 * Handles Update Logic.
 * @package Genpedia
 */
class Edit extends Controller
{
    public function index($id)
    {
        $char = $this->model('Character')->getCharacterById($id);
        $this->view('characters/edit', ['char' => $char]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'element' => trim($_POST['element']),
                'weapon' => trim($_POST['weapon']),
                'rarity' => trim($_POST['rarity']),
                'region' => trim($_POST['region']),
                'description' => trim($_POST['description'])
            ];
            if ($this->model('CharacterWriter')->update($data)) {
                header('Location: ' . URLROOT);
            }
        }
    }
}