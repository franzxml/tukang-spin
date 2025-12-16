<?php
/**
 * Character Read Operations.
 */

namespace App\Models\Traits;

use PDO;

trait CharacterReads
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
     * @param mixed $id
     * @return mixed
     */
    public function getById($id)
    {
        $sql = "SELECT * FROM characters WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}