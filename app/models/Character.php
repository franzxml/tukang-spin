<?php
/**
 * Character Model
 * @package Genpedia
 */
class Character
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getCharacters()
    {
        $this->db->query('SELECT * FROM characters');
        return $this->db->resultSet();
    }

    public function add($data)
    {
        $sql = "INSERT INTO characters (name, element, weapon, rarity, region, description) 
                VALUES (:nm, :el, :wp, :rr, :rg, :ds)";
        
        $this->db->query($sql);
        $this->db->bind(':nm', $data['name']);
        $this->db->bind(':el', $data['element']);
        $this->db->bind(':wp', $data['weapon']);
        $this->db->bind(':rr', $data['rarity']);
        $this->db->bind(':rg', $data['region']);
        $this->db->bind(':ds', $data['description']);

        return $this->db->execute();
    }
}