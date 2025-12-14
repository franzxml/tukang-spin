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
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC');
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

    /**
     * Adds a new character to the database.
     *
     * @param array $data The POST data containing character details.
     * @return int Returns the number of affected rows.
     */
    public function addCharacter(array $data): int
    {
        $query = "INSERT INTO characters (name, element, weapon_type, rarity, role, image_url)
                  VALUES (:name, :element, :weapon_type, :rarity, :role, :image_url)";

        $this->db->query($query);
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('element', $data['element']);
        $this->db->bind('weapon_type', $data['weapon_type']);
        $this->db->bind('rarity', $data['rarity']);
        $this->db->bind('role', htmlspecialchars($data['role']));
        $this->db->bind('image_url', $data['image_url']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    /**
     * Deletes a character from the database.
     *
     * @param int $id The ID of the character to delete.
     * @return int Returns the number of affected rows.
     */
    public function deleteCharacter(int $id): int
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('id', $id);
        
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    /**
     * Updates an existing character in the database.
     *
     * @param array $data The POST data containing character details and ID.
     * @return int Returns the number of affected rows.
     */
    public function updateCharacter(array $data): int
    {
        $query = "UPDATE characters SET
                    name = :name,
                    element = :element,
                    weapon_type = :weapon_type,
                    rarity = :rarity,
                    role = :role,
                    image_url = :image_url
                  WHERE id = :id";

        $this->db->query($query);
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('element', $data['element']);
        $this->db->bind('weapon_type', $data['weapon_type']);
        $this->db->bind('rarity', $data['rarity']);
        $this->db->bind('role', htmlspecialchars($data['role']));
        $this->db->bind('image_url', $data['image_url']);
        $this->db->bind('id', $data['id']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}