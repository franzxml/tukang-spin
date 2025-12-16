<?php
/**
 * Character Write Trait.
 *
 * Handles data persistence operations.
 *
 * @package App\Models\Traits
 */
trait CharacterWrite {
    /**
     * Add a new character.
     * Only includes Name, Weapon, Level, Talents.
     *
     * @param array $data
     * @return bool
     */
    public function add($data) {
        $sql = "INSERT INTO characters (name, weapon, level, talents_level) VALUES (:name, :weapon, :level, :talents)";
        $this->db->query($sql);
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':weapon', $data['weapon']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':talents', $data['talents_level']);
        
        return $this->db->execute();
    }

    /**
     * Edit existing character.
     * Includes all fields.
     */
    public function edit($data) {
        $sql = "UPDATE characters SET name = :name, element = :element, weapon = :weapon, rarity = :rarity, region = :region, level = :level, talents_level = :talents WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->bindAllParams($data);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM characters WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    /**
     * Helper to bind all params (used in Edit).
     */
    private function bindAllParams($data) {
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':element', $data['element']);
        $this->db->bind(':weapon', $data['weapon']);
        $this->db->bind(':rarity', $data['rarity']);
        $this->db->bind(':region', $data['region']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':talents', $data['talents_level']);
    }
}