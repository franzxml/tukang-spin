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
     * Display the list of characters.
     *
     * @return void
     */
    public function index(): void
    {
        $characterModel = new Character();
        $characters = $characterModel->getAll();

        $data = [
            'title'      => 'Genpedia - Characters',
            'css'        => 'characters',
            'js'         => 'characters',
            'characters' => $characters
        ];

        $this->view('pages/characters/index', $data);
    }
}