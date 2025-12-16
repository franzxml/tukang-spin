<?php

/**
 * Class Home
 * The default controller for the Genpedia application.
 */
class Home extends Controller
{
    public function index(): void
    {
        $data['title'] = 'Beranda';
        
        // Fetch dynamic stats for all categories
        $characterModel = $this->model('CharacterModel');
        $weaponModel = $this->model('WeaponModel');
        $artifactModel = $this->model('ArtifactModel');

        $data['total_characters'] = $characterModel->countCharacters();
        $data['total_weapons'] = $weaponModel->countWeapons();
        $data['total_artifacts'] = $artifactModel->countArtifacts();

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}