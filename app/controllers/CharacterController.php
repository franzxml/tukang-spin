<?php
/**
 * Character Controller.
 * Manages character interactions via traits.
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Controllers\Traits\CharacterListing;
use App\Controllers\Traits\CharacterForms;
use App\Controllers\Traits\CharacterWriteActions;

class CharacterController extends Controller
{
    use CharacterListing;
    use CharacterForms;
    use CharacterWriteActions;
}