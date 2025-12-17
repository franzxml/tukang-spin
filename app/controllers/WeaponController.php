<?php
/**
 * Weapon Controller
 * 
 * @package Genpedia
 * @author franzxml
 */

class WeaponController extends Controller
{
    /**
     * Display weapon page
     * 
     * @return void
     */
    public function index()
    {
        $this->view('weapon');
    }

    /**
     * Display add weapon page
     * 
     * @return void
     */
    public function add()
    {
        $this->view('weapon-add');
    }
}