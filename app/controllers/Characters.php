<?php
/**
 * Characters Controller.
 *
 * Manages character CRUD operations via Traits.
 *
 * @package App\Controllers
 */

require_once 'traits/CharacterActions.php';

class Characters extends Controller {
    use CharacterActions;

    private $characterModel;

    public function __construct() {
        $this->characterModel = $this->model('Character');
    }

    public function index() {
        $data = [
            'characters' => $this->characterModel->getCharacters()
        ];
        $this->view('characters/index', $data);
    }

    public function add() {
        $this->handleForm('add');
    }

    public function edit($id) {
        $this->handleForm('edit', $id);
    }

    public function show($id) {
        $character = $this->characterModel->getCharacterById($id);
        $this->view('characters/show', ['character' => $character]);
    }
}