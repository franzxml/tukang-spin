<?php
require_once 'config.php';

/**
 * Database Class
 * Handles PDO connection and queries.
 * @package Genpedia
 */
class Database
{
    private $dbh;
    private $stmt;

    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $opts = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $opts);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            // Auto-detect type logic would go here
            // Simplified for space:
            $type = PDO::PARAM_STR; 
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    public function execute()
    {
        return $this->stmt->execute();
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
}