<?php
/**
 * Weapon Model (Read)
 * @package Genpedia
 */
class Weapon
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getWeapons()
    {
        $this->db->query('SELECT * FROM weapons');
        return $this->db->resultSet();
    }
}