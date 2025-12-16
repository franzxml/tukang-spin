<?php
/**
 * Character Model.
 *
 * Connects Database and Traits.
 *
 * @package App\Models
 */

require_once '../app/core/database/Database.php';
require_once 'traits/CharacterRead.php';
require_once 'traits/CharacterWrite.php';

class Character {
    use CharacterRead;
    use CharacterWrite;

    private $db;

    /**
     * Initialize Database.
     */
    public function __construct() {
        $this->db = new Database();
    }
}