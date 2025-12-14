<?php

/**
 * Class Home
 *
 * The default controller for the Genpedia application.
 * Handles the rendering of the homepage.
 *
 * @package App\Controllers
 */
class Home extends Controller
{
    /**
     * The default method for the Home controller.
     * Renders the header, index view, and footer.
     *
     * @return void
     */
    public function index(): void
    {
        // Data to be passed to the views
        $data['title'] = 'Dashboard';

        // Load Views
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}