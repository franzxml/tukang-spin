<?php
/**
 * Home Controller
 * 
 * @package Genpedia
 * @author franzxml
 */

class HomeController extends Controller
{
    /**
     * Display homepage
     * 
     * @return void
     */
    public function index()
    {
        $this->view('home');
    }
}