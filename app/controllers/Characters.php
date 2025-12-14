<?php

/**
 * Class Characters
 *
 * Controller for handling character listing, creation, details, and updates.
 * Now manages Weapon equipping logic.
 *
 * @package App\Controllers
 */
class Characters extends Controller
{
    /**
     * Index: Display Roster
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
     * Detail: Show Profile
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
     * Add: Show Create Form
     */
    public function add(): void
    {
        $data['title'] = 'Add New Character';
        
        // Load weapons for the dropdown
        $data['weapons'] = $this->model('WeaponModel')->getAllWeapons();

        $this->view('templates/header', $data);
        $this->view('characters/add', $data);
        $this->view('templates/footer');
    }

    /**
     * Store: Process Creation
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
     * Edit: Show Update Form
     */
    public function edit(int $id): void
    {
        $data['title'] = 'Edit Character';
        $data['character'] = $this->model('CharacterModel')->getCharacterById($id);
        
        // Load weapons for the dropdown
        $data['weapons'] = $this->model('WeaponModel')->getAllWeapons();

        $this->view('templates/header', $data);
        $this->view('characters/edit', $data);
        $this->view('templates/footer');
    }

    /**
     * Update: Process Changes
     */
    public function update(): void
    {
        if ($this->model('CharacterModel')->updateCharacter($_POST) > 0) {
            Flasher::setFlash('Character', 'successfully updated', 'success');
            header('Location: ' . BASEURL . '/characters/detail/' . $_POST['id']); // Redirect to detail
            exit;
        } else {
            Flasher::setFlash('Character', 'updated (or no changes)', 'success');
            header('Location: ' . BASEURL . '/characters/detail/' . $_POST['id']);
            exit;
        }
    }

    /**
     * Delete: Remove Character
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
     * Search (Fallback)
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
     * AJAX Live Search
     */
    public function liveSearch(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $keyword = $input['keyword'] ?? '';
        $data['characters'] = $this->model('CharacterModel')->searchCharacters($keyword);
        $this->view('characters/list', $data);
    }
}