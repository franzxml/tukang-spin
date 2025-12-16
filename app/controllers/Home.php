<?php
/**
 * Home Controller.
 *
 * The default landing controller.
 *
 * @package App\Controllers
 */
class Home extends Controller {
    /**
     * Default constructor.
     */
    public function __construct() {
        // Model initialization can go here
    }

    /**
     * Render the homepage.
     *
     * @return void
     */
    public function index() {
        $data = [
            'title' => 'Genpedia',
            'description' => 'Genshin Impact Private Database'
        ];

        $this->view('home/index', $data);
    }
}