<?php

/**
 * Class Home
 *
 * The default controller for the Genpedia application.
 * Localized to Indonesian.
 *
 * @package App\Controllers
 */
class Home extends Controller
{
    /**
     * The default method for the Home controller.
     * Renders the header, index view, and footer.
     * Passes the total character count to the view.
     *
     * @return void
     */
    public function index(): void
    {
        // Data to be passed to the views
        $data['title'] = 'Beranda';
        
        // Fetch dynamic stats
        $characterModel = $this->model('CharacterModel');
        $data['total_characters'] = $characterModel->countCharacters();

        // Load Views
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}