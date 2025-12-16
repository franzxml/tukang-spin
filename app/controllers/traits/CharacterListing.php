<?php
/**
 * Character Listing Trait.
 */

namespace App\Controllers\Traits;

use App\Models\Character;

trait CharacterListing
{
    /**
     * Display character list.
     */
    public function index(): void
    {
        $model = new Character();
        $this->view('pages/characters/index', [
            'title' => 'Genpedia - Characters',
            'css' => 'characters',
            'characters' => $model->getAll()
        ]);
    }
}