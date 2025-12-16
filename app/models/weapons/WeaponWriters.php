<?php
/**
 * Weapon Writer Model
 * @package Genpedia
 */
class WeaponWriter
{
    private $db;

    public function __construct() { $this->db = new Database(); }

    public function add($data)
    {
        $sql = "INSERT INTO weapons (name, type, rarity, base_atk, description) 
                VALUES (:nm, :tp, :rr, :ba, :ds)";
        
        $this->db->query($sql);
        $this->db->bind(':nm', $data['name']);
        $this->db->bind(':tp', $data['type']);
        $this->db->bind(':rr', $data['rarity']);
        $this->db->bind(':ba', $data['base_atk']);
        $this->db->bind(':ds', $data['description']);

        return $this->db->execute();
    }
}