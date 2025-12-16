<?php
/**
 * Character Remover Model
 * Handles deletion logic only.
 * @package Genpedia
 */
class CharacterRemover
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Delete character by ID
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $sql = "DELETE FROM characters WHERE id = :id";
        
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        
        return $this->db->execute();
    }
}