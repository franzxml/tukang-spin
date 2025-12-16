<?php
/**
 * Characters Controller.
 *
 * Manages character CRUD operations.
 *
 * @package App\Controllers
 */
class Characters extends Controller {
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'element' => trim($_POST['element']),
                'weapon' => trim($_POST['weapon']),
                'rarity' => trim($_POST['rarity']),
                'region' => trim($_POST['region'])
            ];

            if ($this->characterModel->add($data)) {
                header('Location: ' . URLROOT . '/characters');
            } else {
                die('Something went wrong');
            }
        } else {
            $this->view('characters/add');
        }
    }
}