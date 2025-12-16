<?php
/**
 * Character Controller.
 * Manages character interactions via traits.
 */

namespace App\Controllers;

use App\Core\Controller;
use App\Controllers\Traits\CharacterReadActions;
use App\Controllers\Traits\CharacterWriteActions;

class CharacterController extends Controller
{
    use CharacterReadActions;
    use CharacterWriteActions;
}