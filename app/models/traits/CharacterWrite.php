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
     * @param array $data
     * @return bool
     */
    public function add($data) {
        $sql = "INSERT INTO characters (name, element, weapon, rarity, region) VALUES (:name, :element, :weapon, :rarity, :region)";
        $this->db->query($sql);
        return $this->bindParams($data);
    }

    /**
     * Edit/Update existing character.
     * @param array $data
     * @return bool
     */
    public function edit($data) {
        $sql = "UPDATE characters SET name = :name, element = :element, weapon = :weapon, rarity = :rarity, region = :region WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        return $this->bindParams($data);
    }

    /**
     * Helper to bind standard params.
     * @param array $data
     * @return bool
     */
    private function bindParams($data) {
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':element', $data['element']);
        $this->db->bind(':weapon', $data['weapon']);
        $this->db->bind(':rarity', $data['rarity']);
        $this->db->bind(':region', $data['region']);
        return $this->db->execute();
    }
}