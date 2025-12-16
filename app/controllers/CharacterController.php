<?php
/**
 * Character Controller.
 * Manages Character listing and interactions.
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Character;

class CharacterController extends Controller
{
    /**
     * Display list.
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
     * Handle create submission.
     */
    public function store(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new Character();
            $model->create($_POST);
            header('Location: /character');
            exit;
        }
    }

    /**
     * Show edit form.
     * @param int $id
     */
    public function edit($id): void
    {
        $model = new Character();
        $character = $model->getById($id);

        if (!$character) {
            header('Location: /character');
            exit;
        }

        $this->view('pages/characters/edit', [
            'title' => 'Edit Character',
            'css' => 'characters',
            'character' => $character
        ]);
    }

    /**
     * Handle edit submission.
     * @param int $id
     */
    public function update($id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new Character();
            $model->update($id, $_POST);
            header('Location: /character');
            exit;
        }
    }
}