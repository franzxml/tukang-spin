<?php

class Characters extends Controller
{
    public function index(): void
    {
        $data['title'] = 'Koleksi Karakter';
        $data['characters'] = $this->model('CharacterModel')->getAllCharacters();
        $this->view('templates/header', $data);
        $this->view('characters/index', $data);
        $this->view('templates/footer');
    }

    public function detail(int $id): void
    {
        $charModel = $this->model('CharacterModel');
        $data['character'] = $charModel->getCharacterById($id);

        if (!$data['character']) {
            Flasher::setFlash('Karakter', 'tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }

        // Fetch compatible weapons for hover effect (excluding current)
        $weaponType = $data['character']['weapon_type'];
        $currentWeaponId = $data['character']['equipped_weapon_id'];
        $data['alt_weapons'] = $charModel->getCompatibleWeapons($weaponType, $currentWeaponId);

        $data['title'] = $data['character']['name'] . ' Build';
        $this->view('templates/header', $data);
        $this->view('characters/detail', $data);
        $this->view('templates/footer');
    }

    public function add(): void
    {
        $data['title'] = 'Tambah Karakter';
        $data['weapons'] = $this->model('WeaponModel')->getAllWeapons();
        $data['artifacts'] = $this->model('ArtifactModel')->getAllArtifacts(); // Load Artifacts

        $this->view('templates/header', $data);
        $this->view('characters/add', $data);
        $this->view('templates/footer');
    }

    public function edit(int $id): void
    {
        $data['title'] = 'Edit Karakter';
        $data['character'] = $this->model('CharacterModel')->getCharacterById($id);
        $data['weapons'] = $this->model('WeaponModel')->getAllWeapons();
        $data['artifacts'] = $this->model('ArtifactModel')->getAllArtifacts(); // Load Artifacts

        $this->view('templates/header', $data);
        $this->view('characters/edit', $data);
        $this->view('templates/footer');
    }

    public function store(): void
    {
        if ($this->model('CharacterModel')->addCharacter($_POST) > 0) {
            Flasher::setFlash('Karakter', 'berhasil ditambahkan', 'success');
            header('Location: ' . BASEURL . '/characters');
            exit;
        } else {
            Flasher::setFlash('Karakter', 'gagal ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }
    }

    public function update(): void
    {
        if ($this->model('CharacterModel')->updateCharacter($_POST) > 0) {
            Flasher::setFlash('Karakter', 'berhasil diperbarui', 'success');
            header('Location: ' . BASEURL . '/characters/detail/' . $_POST['id']);
            exit;
        } else {
            Flasher::setFlash('Karakter', 'diperbarui (atau tidak ada perubahan)', 'success');
            header('Location: ' . BASEURL . '/characters/detail/' . $_POST['id']);
            exit;
        }
    }

    public function delete(int $id): void
    {
        if ($this->model('CharacterModel')->deleteCharacter($id) > 0) {
            Flasher::setFlash('Karakter', 'berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/characters');
            exit;
        }
    }

    public function liveSearch(): void
    {
        $input = json_decode(file_get_contents('php://input'), true);
        $data['characters'] = $this->model('CharacterModel')->searchCharacters($input['keyword'] ?? '');
        $this->view('characters/list', $data);
    }
}