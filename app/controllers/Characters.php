<?php
/**
 * Characters Controller (Add)
 * @package Genpedia
 */
class Characters extends Controller
{
    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Updated path
            $writer = $this->model('characters/CharacterWriter');
            $data = [
                'name' => trim($_POST['name']),
                'element' => trim($_POST['element']),
                'weapon' => trim($_POST['weapon']),
                'rarity' => trim($_POST['rarity']),
                'region' => trim($_POST['region']),
                'description' => trim($_POST['description'])
            ];
            if ($writer->add($data)) header('Location: ' . URLROOT);
            else die('Error adding character');
        } else {
            $this->view('characters/add', ['title' => 'Add Character']);
        }
    }
}