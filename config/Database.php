<?php
require_once 'config.php';

/**
 * Database Class
 * PDO Wrapper.
 * @package Genpedia
 */
class Database
{
    private $dbh, $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $opt = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $opt);
        } catch (PDOException $e) { die($e->getMessage()); }
    }

    public function query($sql) { $this->stmt = $this->dbh->prepare($sql); }

    public function bind($p, $v, $t = null)
    {
        if (is_null($t)) $t = PDO::PARAM_STR;
        $this->stmt->bindValue($p, $v, $t);
    }

    public function execute() { return $this->stmt->execute(); }
    public function resultSet() { $this->execute(); return $this->stmt->fetchAll(PDO::FETCH_OBJ); }
    public function single() { $this->execute(); return $this->stmt->fetch(PDO::FETCH_OBJ); }
}