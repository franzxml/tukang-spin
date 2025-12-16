<?php
/**
 * Character Write Trait.
 * Handles data persistence.
 * @package App\Models\Traits
 */
trait CharacterWrite {
    public function add($data) {
        $sql = "INSERT INTO characters (name, icon, namecard, weapon, level, talents_level) VALUES (:name, :icon, :namecard, :weapon, :level, :talents)";
        $this->db->query($sql);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':namecard', $data['namecard']);
        $this->db->bind(':weapon', $data['weapon']);
        $this->db->bind(':level', $data['level']);
        $this->db->bind(':talents', $data['talents_level']);
        return $this->db->execute();
    }

    public function edit($data) {
        $sql = "UPDATE characters SET name=:n, icon=:i, namecard=:nc, weapon=:w, level=:l, talents_level=:t WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':n', $data['name']);
        $this->db->bind(':i', $data['icon']);
        $this->db->bind(':nc', $data['namecard']);
        $this->db->bind(':w', $data['weapon']);
        $this->db->bind(':l', $data['level']);
        $this->db->bind(':t', $data['talents_level']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query("DELETE FROM characters WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}