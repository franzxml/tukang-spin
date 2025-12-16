<?php
/**
 * Character Model.
 * Handles database operations for Characters.
 */

namespace App\Models;

use App\Core\Model;
use PDO;

class Character extends Model
{
    /**
     * Retrieve all characters.
     * @return array
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM characters ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a character by ID.
     * @param int $id
     * @return mixed
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM characters WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new character.
     * @param array $data Input data.
     * @return bool
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO characters (name, element, weapon_type, rarity, region) 
                VALUES (:name, :element, :weapon, :rarity, :region)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name'    => $data['name'],
            ':element' => $data['element'],
            ':weapon'  => $data['weapon'],
            ':rarity'  => $data['rarity'],
            ':region'  => $data['region']
        ]);
    }

    /**
     * Update an existing character.
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool
    {
        $sql = "UPDATE characters SET 
                    name = :name, 
                    element = :element, 
                    weapon_type = :weapon, 
                    rarity = :rarity, 
                    region = :region 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'      => $id,
            ':name'    => $data['name'],
            ':element' => $data['element'],
            ':weapon'  => $data['weapon'],
            ':rarity'  => $data['rarity'],
            ':region'  => $data['region']
        ]);
    }
}