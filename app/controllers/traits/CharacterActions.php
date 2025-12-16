<?php
/**
 * Character Actions Trait.
 *
 * Handles Add and Edit logic to reduce Controller size.
 *
 * @package App\Controllers\Traits
 */
trait CharacterActions {
    /**
     * Handle Add/Edit logic.
     * @param string $mode 'add' or 'edit'
     * @param int|null $id
     */
    private function handleForm($mode, $id = null) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'element' => trim($_POST['element']),
                'weapon' => trim($_POST['weapon']),
                'rarity' => trim($_POST['rarity']),
                'region' => trim($_POST['region'])
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