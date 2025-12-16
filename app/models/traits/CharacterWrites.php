<?php
/**
 * Character Write Operations.
 */

namespace App\Models\Traits;

trait CharacterWrites
{
    /**
     * Create a new character.
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $sql = "INSERT INTO characters 
                (name, element, weapon_type, rarity, region) 
                VALUES (:name, :el, :wp, :rar, :reg)";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'], ':el' => $data['element'],
            ':wp' => $data['weapon'], ':rar' => $data['rarity'],
            ':reg'  => $data['region']
        ]);
    }

    /**
     * Update an existing character.
     * @param mixed $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data): bool
    {
        $sql = "UPDATE characters SET name=:name, element=:el, 
                weapon_type=:wp, rarity=:rar, region=:reg 
                WHERE id=:id";
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id' => $id, ':name' => $data['name'],
            ':el' => $data['element'], ':wp' => $data['weapon'],
            ':rar' => $data['rarity'], ':reg' => $data['region']
        ]);
    }
}