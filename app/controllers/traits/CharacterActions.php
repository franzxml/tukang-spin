<?php
/**
 * Character Actions Trait.
 *
 * Handles Add and Edit logic.
 *
 * @package App\Controllers\Traits
 */
trait CharacterActions {
    private function handleForm($mode, $id = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Common fields
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'weapon' => trim($_POST['weapon']),
                'level' => trim($_POST['level']),
                'talents_level' => trim($_POST['talents_level'])
            ];

            // Only capture these if they exist (for Edit mode compliance)
            $data['element'] = isset($_POST['element']) ? trim($_POST['element']) : null;
            $data['rarity'] = isset($_POST['rarity']) ? trim($_POST['rarity']) : null;
            $data['region'] = isset($_POST['region']) ? trim($_POST['region']) : null;

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