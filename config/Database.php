<?php
require_once 'config.php';

/**
 * Database Class
 *
 * Establishes a PDO connection to the MySQL database.
 *
 * @package Genpedia
 * @author  franzxml
 */
class Database
{
    private $dbh;
    private $error;

    /**
     * Constructor
     * Initializes the PDO connection.
     */
    public function __construct()
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Get Connection
     * returns the active PDO instance.
     *
     * @return PDO|null
     */
    public function connect()
    {
        return $this->dbh;
    }
}