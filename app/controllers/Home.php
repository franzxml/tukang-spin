<?php

/**
 * Class Home
 *
 * The default controller for the Genpedia application.
 *
 * @package App\Controllers
 */
class Home extends Controller
{
    /**
     * The default method for the Home controller.
     * Currently outputs a simple test message.
     *
     * @return void
     */
    public function index(): void
    {
        echo "<h1>Genpedia API is Running</h1>";
        echo "<p>Welcome, Franzxml. The MVC core is active.</p>";
    }
}