<?php
/**
 * Character Writer Model
 * Handles Insert/Update.
 * @package Genpedia
 */
class CharacterWriter
{
    private $db;

    public function __construct() { $this->db = new Database(); }

    public function add($d)
    {
        $sql = "INSERT INTO characters (name, element, weapon, rarity, region, description) 
                VALUES (:nm, :el, :wp, :rr, :rg, :ds)";
        return $this->runQuery($sql, $d);
    }

    public function update($d)
    {
        $sql = "UPDATE characters SET name=:nm, element=:el, weapon=:wp, 
                rarity=:rr, region=:rg, description=:ds WHERE id=:id";
        return $this->runQuery($sql, $d);
    }

    private function runQuery($sql, $d)
    {
        $this->db->query($sql);
        $this->db->bind(':nm', $d['name']);
        $this->db->bind(':el', $d['element']);
        $this->db->bind(':wp', $d['weapon']);
        $this->db->bind(':rr', $d['rarity']);
        $this->db->bind(':rg', $d['region']);
        $this->db->bind(':ds', $d['description']);
        if(isset($d['id'])) $this->db->bind(':id', $d['id']);
        return $this->db->execute();
    }
}