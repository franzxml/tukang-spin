<?php
/**
 * Character Write Trait.
 *
 * Handles data persistence operations.
 *
 * @package App\Models\Traits
 */
trait CharacterWrite {
    public function add($data) {
        $sql = "INSERT INTO characters (name, element, weapon, rarity, region) VALUES (:name, :element, :weapon, :rarity, :region)";
        $this->db->query($sql);
        return $this->bindParams($data);
    }

    public function edit($data) {
        $sql = "UPDATE characters SET name = :name, element = :element, weapon = :weapon, rarity = :rarity, region = :region WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        return $this->bindParams($data);
    }

    /**
     * Delete a character.
     * @param int $id
     * @return bool
     */
    public function delete($id) {
        $this->db->query("DELETE FROM characters WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    private function bindParams($data) {
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':element', $data['element']);
        $this->db->bind(':weapon', $data['weapon']);
        $this->db->bind(':rarity', $data['rarity']);
        $this->db->bind(':region', $data['region']);
        return $this->db->execute();
    }
}