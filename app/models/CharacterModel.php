<?php

/**
 * Class CharacterModel
 *
 * Handles all database interactions for character-related data.
 * Updated to support the new weapon table structure (split sub-stats).
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
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Retrieves all characters with their equipped weapon info.
     *
     * @return array
     */
    public function getAllCharacters(): array
    {
        // Aliasing weapon columns to avoid collision with character columns
        $query = "SELECT c.*, w.name as weapon_name, w.image_url as weapon_image, w.rarity as weapon_rarity 
                  FROM " . $this->table . " c
                  LEFT JOIN weapons w ON c.equipped_weapon_id = w.id
                  ORDER BY c.created_at DESC";
                  
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * Retrieves a single character by ID with weapon info.
     * FIXED: Updated to select sub_stat_type and sub_stat_value instead of the deleted sub_stat column.
     *
     * @param int $id
     * @return mixed
     */
    public function getCharacterById(int $id): mixed
    {
        $query = "SELECT c.*, 
                         w.name as weapon_name, 
                         w.image_url as weapon_image, 
                         w.base_atk as weapon_atk, 
                         w.sub_stat_type as weapon_substat_type, 
                         w.sub_stat_value as weapon_substat_value, 
                         w.rarity as weapon_rarity, 
                         w.description as weapon_desc,
                         w.passive_name as weapon_passive_name
                  FROM " . $this->table . " c
                  LEFT JOIN weapons w ON c.equipped_weapon_id = w.id
                  WHERE c.id = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    /**
     * Adds a new character.
     */
    public function addCharacter(array $data): int
    {
        $query = "INSERT INTO characters 
                  (name, element, weapon_type, rarity, role, equipped_weapon_id, level, constellation, talent_na, talent_skill, talent_burst, description, image_url)
                  VALUES 
                  (:name, :element, :weapon_type, :rarity, :role, :equipped_weapon_id, :level, :constellation, :talent_na, :talent_skill, :talent_burst, :description, :image_url)";

        $this->db->query($query);
        $this->bindParams($data);

        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Updates an existing character.
     */
    public function updateCharacter(array $data): int
    {
        $query = "UPDATE characters SET
                    name = :name,
                    element = :element,
                    weapon_type = :weapon_type,
                    rarity = :rarity,
                    role = :role,
                    equipped_weapon_id = :equipped_weapon_id,
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
     * Deletes a character.
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
     * Search characters.
     */
    public function searchCharacters(string $keyword): array
    {
        $query = "SELECT c.*, w.name as weapon_name 
                  FROM " . $this->table . " c
                  LEFT JOIN weapons w ON c.equipped_weapon_id = w.id
                  WHERE c.name LIKE :keyword";
        
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    /**
     * Helper to bind params.
     */
    private function bindParams(array $data): void
    {
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('element', $data['element']);
        $this->db->bind('weapon_type', $data['weapon_type']);
        $this->db->bind('rarity', $data['rarity']);
        $this->db->bind('role', htmlspecialchars($data['role']));
        
        // Handle Weapon ID (Allow NULL)
        $weaponId = !empty($data['equipped_weapon_id']) ? $data['equipped_weapon_id'] : null;
        $this->db->bind('equipped_weapon_id', $weaponId);

        $this->db->bind('level', $data['level'] ?? 90);
        $this->db->bind('constellation', $data['constellation'] ?? 0);
        $this->db->bind('talent_na', $data['talent_na'] ?? 1);
        $this->db->bind('talent_skill', $data['talent_skill'] ?? 1);
        $this->db->bind('talent_burst', $data['talent_burst'] ?? 1);
        $this->db->bind('description', htmlspecialchars($data['description'] ?? ''));
        $this->db->bind('image_url', $data['image_url']);
    }
}