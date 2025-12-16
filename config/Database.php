<?php
/**
 * Database Configuration.
 * Uses Singleton pattern to maintain a single DB connection.
 */

namespace Config;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $instance = null;

    /**
     * Get the database connection instance.
     *
     * @return PDO
     */
    public static function connect(): PDO
    {
        if (self::$instance === null) {
            $host = 'localhost';
            $db   = 'genpedia';
            $user = 'root';
            $pass = ''; // Default Laragon password is empty

            $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                die('Database connection failed: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}