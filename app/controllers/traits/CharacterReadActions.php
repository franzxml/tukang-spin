<?php
/**
 * Controller Read Actions.
 */

namespace App\Controllers\Traits;

use App\Models\Character;

trait CharacterReadActions
{
    /**
     * Display character list.
     */
    public function index(): void
    {
        $model = new Character();
        $this->view('pages/characters/index', [
            'title' => 'Genpedia - Characters',
            'css' => 'characters',
            'characters' => $model->getAll()
        ]);
    }

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