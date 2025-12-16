<?php
/**
 * Character Read Trait.
 *
 * Handles data retrieval operations.
 *
 * @package App\Models\Traits
 */
trait CharacterRead {
    /**
     * Get all characters.
     * @return array
     */
    public function getCharacters() {
        $this->db->query("SELECT * FROM characters ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    /**
     * Get character by ID.
     * @param int $id
     * @return object
     */
    public function getCharacterById($id) {
        $this->db->query("SELECT * FROM characters WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}