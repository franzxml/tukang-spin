<?php
/**
 * Manage Controller
 * Handles Edit, Update, and Delete actions.
 * @package Genpedia
 */
class Manage extends Controller
{
    public function edit($id)
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

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->model('CharacterRemover')->delete($id)) {
                header('Location: ' . URLROOT);
            }
        }
    }
}