<?php
/**
 * Character Model
 *
 * Interacts with the characters table.
 *
 * @package Genpedia
 * @author  franzxml
 */
class Character
{
    private $db;

    /**
     * Constructor
     * Initialize Database connection.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Get all characters
     *
     * @return array List of characters
     */
    public function getCharacters()
    {
        $this->db->query('SELECT * FROM characters');
        return $this->db->resultSet();
    }
}