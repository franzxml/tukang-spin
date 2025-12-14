<?php

/**
 * Class Weapons
 *
 * Controller for handling weapon armory.
 * Localized to Indonesian.
 *
 * @package App\Controllers
 */
class Weapons extends Controller
{
    /**
     * Display Weapon List
     */
    public function index(): void
    {
        $data['title'] = 'Gudang Senjata';
        $data['weapons'] = $this->model('WeaponModel')->getAllWeapons();

        $this->view('templates/header', $data);
        $this->view('weapons/index', $data);
        $this->view('templates/footer');
    }

    /**
     * Show Add Form
     */
    public function add(): void
    {
        $data['title'] = 'Tambah Senjata';
        
        $this->view('templates/header', $data);
        $this->view('weapons/add', $data);
        $this->view('templates/footer');
    }

    /**
     * Process Add Logic
     */
    public function store(): void
    {
        if ($this->model('WeaponModel')->addWeapon($_POST) > 0) {
            Flasher::setFlash('Senjata', 'berhasil ditambahkan', 'success');
            header('Location: ' . BASEURL . '/weapons');
            exit;
        } else {
            Flasher::setFlash('Senjata', 'gagal ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/weapons');
            exit;
        }
    }

    /**
     * Delete Weapon
     */
    public function delete(int $id): void
    {
        if ($this->model('WeaponModel')->deleteWeapon($id) > 0) {
            Flasher::setFlash('Senjata', 'berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/weapons');
            exit;
        }
    }
}