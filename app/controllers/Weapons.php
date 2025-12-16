<?php
/**
 * Weapons Controller
 * Handles listing and adding weapons.
 * @package Genpedia
 */
class Weapons extends Controller
{
    public function index()
    {
        $weapons = $this->model('weapons/Weapon')->getWeapons();
        $this->view('weapons/index', ['weapons' => $weapons]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'type' => trim($_POST['type']),
                'rarity' => trim($_POST['rarity']),
                'base_atk' => trim($_POST['base_atk']),
                'description' => trim($_POST['description'])
            ];
            
            if ($this->model('weapons/WeaponWriter')->add($data)) {
                header('Location: ' . URLROOT . '/weapons');
            }
        } else {
            $this->view('weapons/add');
        }
    }
}