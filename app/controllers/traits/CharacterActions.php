<?php
/**
 * Character Actions Trait.
 * Handles Add and Edit logic.
 * @package App\Controllers\Traits
 */
trait CharacterActions {
    private function handleForm($mode, $id = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $talents = [
                $_POST['talent_na'],
                $_POST['talent_es'],
                $_POST['talent_eb']
            ];
            
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'icon' => trim($_POST['icon']),
                'namecard' => trim($_POST['namecard']),
                'weapon' => trim($_POST['weapon']),
                'level' => trim($_POST['level']),
                'talents_level' => implode('/', $talents)
            ];

            if ($this->characterModel->$mode($data)) {
                header('Location: ' . URLROOT . '/characters');
            } else {
                die('Operation failed');
            }
        } else {
            $data = ($mode == 'edit') ? $this->characterModel->getCharacterById($id) : [];
            $this->view("characters/$mode", ['data' => $data]);
        }
    }
}