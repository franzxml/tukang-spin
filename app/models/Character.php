<?php
/**
 * Character Model.
 *
 * Interact with the characters table.
 *
 * @package App\Models
 */

require_once '../app/core/database/Database.php';

class Character {
    private $db;

    /**
     * Initialize Database.
     */
    public function __construct() {
        $this->db = new Database();
    }

    /**
     * Get all characters.
     *
     * @return array List of characters.
     */
    public function getCharacters() {
        $this->db->query("SELECT * FROM characters");
        return $this->db->resultSet();
    }
}