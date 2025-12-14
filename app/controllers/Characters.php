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

    /**
     * Deletes a character by ID.
     *
     * @param int $id The ID of the character to delete.
     * @return void
     */
    public function delete(int $id): void
    {
        if ($this->model('CharacterModel')->deleteCharacter($id) > 0) {
            Flasher::setFlash('Character', 'successfully deleted', 'success');
            header('Location: ' . BASEURL . '/characters');
            exit;
        } else {
            Flasher::setFlash('Character', 'failed to delete', 'danger');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }
    }

    /**
     * Displays the form to edit an existing character.
     *
     * @param int $id The ID of the character to edit.
     * @return void
     */
    public function edit(int $id): void
    {
        $data['title'] = 'Edit Character';
        $data['character'] = $this->model('CharacterModel')->getCharacterById($id);

        $this->view('templates/header', $data);
        $this->view('characters/edit', $data);
        $this->view('templates/footer');
    }

    /**
     * Processes the update character form submission.
     *
     * @return void
     */
    public function update(): void
    {
        if ($this->model('CharacterModel')->updateCharacter($_POST) > 0) {
            Flasher::setFlash('Character', 'successfully updated', 'success');
            header('Location: ' . BASEURL . '/characters');
            exit;
        } else {
            Flasher::setFlash('Character', 'updated (or no changes made)', 'success');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }
    }

    /**
     * Handles the search request.
     *
     * @return void
     */
    public function search(): void
    {
        $data['title'] = 'Search Results';
        
        // Retrieve keyword from POST or set to empty string
        $keyword = $_POST['keyword'] ?? '';
        
        $data['characters'] = $this->model('CharacterModel')->searchCharacters($keyword);
        
        $this->view('templates/header', $data);
        $this->view('characters/index', $data);
        $this->view('templates/footer');
    }
}