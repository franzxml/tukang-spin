<?php

/**
 * Class CharacterModel
 *
 * Handles database interactions for character-related data.
 *
 * @package App\Models
 */
class CharacterModel
{
    /** @var string $table The database table name */
    private string $table = 'characters';

    /** @var Database $db The database wrapper instance */
    private Database $db;

    /**
     * CharacterModel constructor.
     * Initializes the database connection.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Retrieves all characters from the database.
     *
     * @return array Returns an array of associative arrays representing characters.
     */
    public function getAllCharacters(): array
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    /**
     * Retrieves a single character by ID.
     *
     * @param int $id The character ID.
     * @return mixed Returns an associative array or false if not found.
     */
    public function getCharacterById(int $id): mixed
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}