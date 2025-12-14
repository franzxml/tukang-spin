<?php

/**
 * Class Characters
 *
 * Controller for handling character listing and details.
 *
 * @package App\Controllers
 */
class Characters extends Controller
{
    /**
     * The default method.
     * Fetches all characters and displays them in a grid view.
     *
     * @return void
     */
    public function index(): void
    {
        $data['title'] = 'Character Roster';
        
        // Instantiate the model and get data
        $characterModel = $this->model('CharacterModel');
        $data['characters'] = $characterModel->getAllCharacters();

        $this->view('templates/header', $data);
        $this->view('characters/index', $data);
        $this->view('templates/footer');
    }
}