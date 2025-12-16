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
     * Default method called by Router.
     *
     * @return void
     */
    public function index(): void
    {
        echo "<h1>Genpedia Router Active</h1>";
        echo "<p>Current Controller: <strong>HomeController</strong></p>";
        echo "<p>Current Method: <strong>index</strong></p>";
    }
}