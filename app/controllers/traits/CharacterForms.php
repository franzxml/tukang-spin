<?php
/**
 * Character Forms Trait.
 */

namespace App\Controllers\Traits;

use App\Models\Character;

trait CharacterForms
{
    /**
     * Show create form.
     */
    public function create(): void
    {
        $this->view('pages/characters/create', [
            'title' => 'Add Character',
            'css' => 'characters'
        ]);
    }

    /**
     * Show edit form.
     * @param mixed $id
     */
    public function edit($id): void
    {
        $model = new Character();
        $char = $model->getById($id);

        if (!$char) {
            header('Location: /character');
            exit;
        }

        $this->view('pages/characters/edit', [
            'title' => 'Edit Character',
            'css' => 'characters',
            'character' => $char
        ]);
    }
}