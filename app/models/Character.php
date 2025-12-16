<?php
/**
 * Character Model.
 * Composes traits for database interactions.
 */

namespace App\Models;

use App\Core\Model;
use App\Models\Traits\CharacterReads;
use App\Models\Traits\CharacterWrites;

class Character extends Model
{
    use CharacterReads;
    use CharacterWrites;
}