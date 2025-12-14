<?php

/**
 * Class CharacterModel
 *
 * Handles all database interactions for character-related data.
 * This class includes CRUD operations and search functionality.
 * Updated to support extended metadata (Level, Constellation, Talents).
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
     * Ordered by newest created first.
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
     * Includes extended metadata (stats and description).
     *
     * @param array $data The POST data containing character details.
     * @return int Returns the number of affected rows.
     */
    public function addCharacter(array $data): int
    {
        $query = "INSERT INTO characters 
                  (name, element, weapon_type, rarity, role, level, constellation, talent_na, talent_skill, talent_burst, description, image_url)
                  VALUES 
                  (:name, :element, :weapon_type, :rarity, :role, :level, :constellation, :talent_na, :talent_skill, :talent_burst, :description, :image_url)";

        $this->db->query($query);
        $this->bindParams($data);

        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Updates an existing character in the database.
     * Includes extended metadata.
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
                    level = :level,
                    constellation = :constellation,
                    talent_na = :talent_na,
                    talent_skill = :talent_skill,
                    talent_burst = :talent_burst,
                    description = :description,
                    image_url = :image_url
                  WHERE id = :id";

        $this->db->query($query);
        $this->bindParams($data);
        $this->db->bind('id', $data['id']);

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
     * Search characters by name.
     * Used for both standard search and AJAX live search.
     *
     * @param string $keyword The keyword to search for.
     * @return array The list of matching characters.
     */
    public function searchCharacters(string $keyword): array
    {
        $query = "SELECT * FROM " . $this->table . " WHERE name LIKE :keyword";
        
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        
        return $this->db->resultSet();
    }

    /**
     * Helper method to bind parameters for add and update operations.
     * Reduces code duplication.
     *
     * @param array $data The data array.
     * @return void
     */
    private function bindParams(array $data): void
    {
        // Use htmlspecialchars for string inputs to prevent XSS
        // Use defaults/null coalescing for optional fields if they are missing
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('element', $data['element']);
        $this->db->bind('weapon_type', $data['weapon_type']);
        $this->db->bind('rarity', $data['rarity']);
        $this->db->bind('role', htmlspecialchars($data['role']));
        
        // Extended Meta Data
        $this->db->bind('level', $data['level'] ?? 90);
        $this->db->bind('constellation', $data['constellation'] ?? 0);
        $this->db->bind('talent_na', $data['talent_na'] ?? 1);
        $this->db->bind('talent_skill', $data['talent_skill'] ?? 1);
        $this->db->bind('talent_burst', $data['talent_burst'] ?? 1);
        $this->db->bind('description', htmlspecialchars($data['description'] ?? ''));
        
        $this->db->bind('image_url', $data['image_url']);
    }
}