<?php
/**
 * Character Model (Read)
 * Handles data retrieval.
 * @package Genpedia
 */
class Character
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCharacters()
    {
        $this->db->query('SELECT * FROM characters');
        return $this->db->resultSet();
    }

    public function getCharacterById($id)
    {
        $sql = "SELECT * FROM characters WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function searchCharacters($term)
    {
        $sql = "SELECT * FROM characters WHERE name LIKE :t OR element LIKE :t";
        $this->db->query($sql);
        $this->db->bind(':t', "%$term%");
        return $this->db->resultSet();
    }
}