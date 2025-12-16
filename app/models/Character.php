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
     *
     * @return array
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM characters ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}