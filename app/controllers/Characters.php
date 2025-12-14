<?php

/**
 * Class Characters
 *
 * Controller for handling character listing, creation, and details.
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

    /**
     * Displays the form to add a new character.
     *
     * @return void
     */
    public function add(): void
    {
        $data['title'] = 'Add New Character';
        
        $this->view('templates/header', $data);
        $this->view('characters/add', $data);
        $this->view('templates/footer');
    }

    /**
     * Processes the add character form submission.
     *
     * @return void
     */
    public function store(): void
    {
        if ($this->model('CharacterModel')->addCharacter($_POST) > 0) {
            Flasher::setFlash('Character', 'successfully added', 'success');
            header('Location: ' . BASEURL . '/characters');
            exit;
        } else {
            Flasher::setFlash('Character', 'failed to add', 'danger');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }
    }
}