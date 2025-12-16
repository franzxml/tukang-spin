<?php
/**
 * Character Actions Trait.
 *
 * Handles Add and Edit logic including new stats.
 *
 * @package App\Controllers\Traits
 */
trait CharacterActions {
    private function handleForm($mode, $id = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'element' => trim($_POST['element']),
                'weapon' => trim($_POST['weapon']),
                'rarity' => trim($_POST['rarity']),
                'region' => trim($_POST['region']),
                'level' => trim($_POST['level']),
                'talents_level' => trim($_POST['talents_level'])
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