<?php
/**
 * Default Home Controller.
 * Landing page logic.
 */

namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller
{
    /**
     * Render the home page.
     *
     * @return void
     */
    public function index(): void
    {
        $data = [
            'title' => 'Genpedia - Home',
            'css'   => 'home',
            'js'    => 'home'
        ];

        $this->view('pages/home', $data);
    }
}