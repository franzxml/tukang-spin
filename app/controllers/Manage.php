<?php
/**
 * Manage Controller
 * @package Genpedia
 */
class Manage extends Controller
{
    public function edit($id)
    {
        $char = $this->model('characters/Character')->getCharacterById($id);
        $this->view('characters/edit', ['char' => $char]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = $_POST; // Simplified for brevity, normally explicit
            $data['id'] = $id;
            $this->model('characters/CharacterWriter')->update($data);
            header('Location: ' . URLROOT);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model('characters/CharacterRemover')->delete($id);
            header('Location: ' . URLROOT);
        }
    }
}