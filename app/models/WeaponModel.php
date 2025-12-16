<?php

/**
 * Class WeaponModel
 * Handles database interactions for weapon-related data.
 */
class WeaponModel
{
    private string $table = 'weapons';
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllWeapons(): array
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY rarity DESC, base_atk DESC');
        return $this->db->resultSet();
    }

    // NEW: Count total weapons
    public function countWeapons(): int
    {
        $this->db->query("SELECT COUNT(*) as count FROM " . $this->table);
        $row = $this->db->single();
        return (int) $row['count'];
    }

    public function addWeapon(array $data): int
    {
        $query = "INSERT INTO weapons (name, type, rarity, base_atk, sub_stat_type, sub_stat_value, passive_name, description, image_url)
                  VALUES (:name, :type, :rarity, :base_atk, :sub_stat_type, :sub_stat_value, :passive_name, :description, :image_url)";

        $this->db->query($query);
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('type', $data['type']);
        $this->db->bind('rarity', $data['rarity']);
        $this->db->bind('base_atk', $data['base_atk']);
        $this->db->bind('sub_stat_type', htmlspecialchars($data['sub_stat_type']));
        $this->db->bind('sub_stat_value', htmlspecialchars($data['sub_stat_value']));
        $this->db->bind('passive_name', htmlspecialchars($data['passive_name']));
        $this->db->bind('description', htmlspecialchars($data['description'] ?? ''));
        $this->db->bind('image_url', $data['image_url']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteWeapon(int $id): int
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}