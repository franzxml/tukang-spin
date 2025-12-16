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

    public function __construct() {
        $this->db = new Database();
    }

    public function getCharacters() {
        $this->db->query("SELECT * FROM characters ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    /**
     * Add a new character.
     * @param array $data Character data.
     * @return bool Success status.
     */
    public function add($data) {
        $this->db->query("INSERT INTO characters (name, element, weapon, rarity, region) VALUES (:name, :element, :weapon, :rarity, :region)");
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':element', $data['element']);
        $this->db->bind(':weapon', $data['weapon']);
        $this->db->bind(':rarity', $data['rarity']);
        $this->db->bind(':region', $data['region']);

        return $this->db->execute();
    }
}