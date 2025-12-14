<?php

/**
 * Class Characters
 *
 * Controller for handling character listing, creation, details, and updates.
 * Manages interactions between the View and the CharacterModel.
 *
 * @package App\Controllers
 */
class Characters extends Controller
{
    /**
     * The default method.
     * Fetches all characters and displays them in a grid view using partials.
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
     * Displays the detailed view of a single character.
     * Shows expanded metadata like stats and talents.
     *
     * @param int $id The character ID.
     * @return void
     */
    public function detail(int $id): void
    {
        $data['character'] = $this->model('CharacterModel')->getCharacterById($id);

        if (!$data['character']) {
            Flasher::setFlash('Character', 'not found', 'danger');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }

        $data['title'] = $data['character']['name'] . ' Build';
        
        $this->view('templates/header', $data);
        $this->view('characters/detail', $data);
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
            // Note: 0 rows affected might mean no data changed, but we treat it as success-ish
            Flasher::setFlash('Character', 'updated (or no changes made)', 'success');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }
    }

    /**
     * Handles the regular search request (Fallback for non-JS).
     *
     * @return void
     */
    public function search(): void
    {
        $data['title'] = 'Search Results';
        
        $keyword = $_POST['keyword'] ?? '';
        
        $data['characters'] = $this->model('CharacterModel')->searchCharacters($keyword);
        
        $this->view('templates/header', $data);
        $this->view('characters/index', $data);
        $this->view('templates/footer');
    }

    /**
     * Handles the AJAX Live Search request.
     * Returns ONLY the HTML partial of the character grid (list.php).
     *
     * @return void
     */
    public function liveSearch(): void
    {
        // Get the JSON input from fetch API
        $input = json_decode(file_get_contents('php://input'), true);
        $keyword = $input['keyword'] ?? '';

        $data['characters'] = $this->model('CharacterModel')->searchCharacters($keyword);
        
        // Load ONLY the list partial view
        $this->view('characters/list', $data);
    }
}