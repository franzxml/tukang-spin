<?php

/**
 * Class CharacterModel
 *
 * Handles database interactions for character-related data.
 * Updated to include a counting method for the dashboard.
 *
 * @package App\Models
 */
class CharacterModel
{
    private string $table = 'characters';
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllCharacters(): array
    {
        $query = "SELECT c.*, w.name as weapon_name, w.image_url as weapon_image, w.rarity as weapon_rarity 
                  FROM " . $this->table . " c
                  LEFT JOIN weapons w ON c.equipped_weapon_id = w.id
                  ORDER BY c.created_at DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    /**
     * Get the total count of characters in the database.
     * Used for the dashboard stats.
     *
     * @return int
     */
    public function countCharacters(): int
    {
        $this->db->query("SELECT COUNT(*) as count FROM " . $this->table);
        $row = $this->db->single();
        return (int) $row['count'];
    }

    public function getCharacterById(int $id): mixed
    {
        $query = "SELECT c.*, 
                         w.name as weapon_name, w.image_url as weapon_image, w.base_atk as weapon_atk, 
                         w.sub_stat_type as weapon_substat_type, w.sub_stat_value as weapon_substat_value, 
                         w.rarity as weapon_rarity, w.description as weapon_desc, w.passive_name as weapon_passive_name,
                         a.name as artifact_name, a.image_url as artifact_image, 
                         a.bonus_2pc as artifact_2pc, a.bonus_4pc as artifact_4pc
                  FROM " . $this->table . " c
                  LEFT JOIN weapons w ON c.equipped_weapon_id = w.id
                  LEFT JOIN artifact_sets a ON c.equipped_artifact_set_id = a.id
                  WHERE c.id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getCompatibleWeapons(string $type, ?int $excludeId): array
    {
        $query = "SELECT * FROM weapons WHERE type = :type";
        if ($excludeId) {
            $query .= " AND id != :excludeId";
        }
        $query .= " ORDER BY rarity DESC, base_atk DESC LIMIT 5";
        $this->db->query($query);
        $this->db->bind('type', $type);
        if ($excludeId) {
            $this->db->bind('excludeId', $excludeId);
        }
        return $this->db->resultSet();
    }

    public function addCharacter(array $data): int
    {
        $query = "INSERT INTO characters 
                  (name, element, weapon_type, rarity, role, equipped_weapon_id, equipped_artifact_set_id, art_sands, art_goblet, art_circlet, level, constellation, talent_na, talent_skill, talent_burst, description, image_url)
                  VALUES 
                  (:name, :element, :weapon_type, :rarity, :role, :equipped_weapon_id, :equipped_artifact_set_id, :art_sands, :art_goblet, :art_circlet, :level, :constellation, :talent_na, :talent_skill, :talent_burst, :description, :image_url)";
        $this->db->query($query);
        $this->bindParams($data);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updateCharacter(array $data): int
    {
        $query = "UPDATE characters SET
                    name = :name, element = :element, weapon_type = :weapon_type, rarity = :rarity, role = :role,
                    equipped_weapon_id = :equipped_weapon_id, equipped_artifact_set_id = :equipped_artifact_set_id,
                    art_sands = :art_sands, art_goblet = :art_goblet, art_circlet = :art_circlet,
                    level = :level, constellation = :constellation,
                    talent_na = :talent_na, talent_skill = :talent_skill, talent_burst = :talent_burst,
                    description = :description, image_url = :image_url
                  WHERE id = :id";
        $this->db->query($query);
        $this->bindParams($data);
        $this->db->bind('id', $data['id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteCharacter(int $id): int
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function searchCharacters(string $keyword): array
    {
        $query = "SELECT c.*, w.name as weapon_name FROM " . $this->table . " c
                  LEFT JOIN weapons w ON c.equipped_weapon_id = w.id
                  WHERE c.name LIKE :keyword";
        $this->db->query($query);
        $this->db->bind('keyword', "%$keyword%");
        return $this->db->resultSet();
    }

    private function bindParams(array $data): void
    {
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('element', $data['element']);
        $this->db->bind('weapon_type', $data['weapon_type']);
        $this->db->bind('rarity', $data['rarity']);
        $this->db->bind('role', htmlspecialchars($data['role']));
        $this->db->bind('equipped_weapon_id', !empty($data['equipped_weapon_id']) ? $data['equipped_weapon_id'] : null);
        $this->db->bind('equipped_artifact_set_id', !empty($data['equipped_artifact_set_id']) ? $data['equipped_artifact_set_id'] : null);
        $this->db->bind('art_sands', $data['art_sands']);
        $this->db->bind('art_goblet', $data['art_goblet']);
        $this->db->bind('art_circlet', $data['art_circlet']);
        $this->db->bind('level', $data['level'] ?? 90);
        $this->db->bind('constellation', $data['constellation'] ?? 0);
        $this->db->bind('talent_na', $data['talent_na'] ?? 1);
        $this->db->bind('talent_skill', $data['talent_skill'] ?? 1);
        $this->db->bind('talent_burst', $data['talent_burst'] ?? 1);
        $this->db->bind('description', htmlspecialchars($data['description'] ?? ''));
        $this->db->bind('image_url', $data['image_url']);
    }
}