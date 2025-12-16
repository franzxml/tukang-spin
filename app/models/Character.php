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
}