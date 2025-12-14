<?php

/**
 * Class WeaponModel
 *
 * Handles database interactions for weapon-related data.
 *
 * @package App\Models
 */
class WeaponModel
{
    /** @var string $table The database table name */
    private string $table = 'weapons';

    /** @var Database $db The database wrapper instance */
    private Database $db;

    /**
     * WeaponModel constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Retrieves all weapons.
     *
     * @return array
     */
    public function getAllWeapons(): array
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY rarity DESC, base_atk DESC');
        return $this->db->resultSet();
    }

    /**
     * Adds a new weapon.
     *
     * @param array $data
     * @return int
     */
    public function addWeapon(array $data): int
    {
        $query = "INSERT INTO weapons (name, type, rarity, base_atk, sub_stat, description, image_url)
                  VALUES (:name, :type, :rarity, :base_atk, :sub_stat, :description, :image_url)";

        $this->db->query($query);
        
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('type', $data['type']);
        $this->db->bind('rarity', $data['rarity']);
        $this->db->bind('base_atk', $data['base_atk']);
        $this->db->bind('sub_stat', htmlspecialchars($data['sub_stat']));
        $this->db->bind('description', htmlspecialchars($data['description'] ?? ''));
        $this->db->bind('image_url', $data['image_url']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    /**
     * Deletes a weapon.
     *
     * @param int $id
     * @return int
     */
    public function deleteWeapon(int $id): int
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}