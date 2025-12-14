<?php

/**
 * Class Artifacts
 *
 * Controller for managing Artifact Sets library.
 *
 * @package App\Controllers
 */
class Artifacts extends Controller
{
    public function index(): void
    {
        $data['title'] = 'Koleksi Artefak';
        $data['artifacts'] = $this->model('ArtifactModel')->getAllArtifacts();

        $this->view('templates/header', $data);
        $this->view('artifacts/index', $data);
        $this->view('templates/footer');
    }

    public function add(): void
    {
        $data['title'] = 'Tambah Set Artefak';
        
        $this->view('templates/header', $data);
        $this->view('artifacts/add', $data);
        $this->view('templates/footer');
    }

    public function store(): void
    {
        if ($this->model('ArtifactModel')->addArtifact($_POST) > 0) {
            Flasher::setFlash('Set Artefak', 'berhasil ditambahkan', 'success');
            header('Location: ' . BASEURL . '/artifacts');
            exit;
        } else {
            Flasher::setFlash('Set Artefak', 'gagal ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/artifacts');
            exit;
        }
    }

    public function delete(int $id): void
    {
        if ($this->model('ArtifactModel')->deleteArtifact($id) > 0) {
            Flasher::setFlash('Set Artefak', 'berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/artifacts');
            exit;
        }
    }
}