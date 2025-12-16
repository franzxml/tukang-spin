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
     * Handle form submission.
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
}