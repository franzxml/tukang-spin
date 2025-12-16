<?php
/**
 * Controller Write Actions.
 */

namespace App\Controllers\Traits;

use App\Models\Character;

trait CharacterWriteActions
{
    /**
     * Handle creation.
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new Character())->create($_POST);
            header('Location: /character');
            exit;
        }
    }

    /**
     * Handle update.
     * @param mixed $id
     */
    public function update($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new Character())->update($id, $_POST);
            header('Location: /character');
            exit;
        }
    }

    /**
     * Handle deletion.
     * @param mixed $id
     */
    public function delete($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new Character())->delete($id);
            header('Location: /character');
            exit;
        }
    }
}