<?php
/**
 * Base Model.
 * Provides database connection instance to children.
 */

namespace App\Core;

use Config\Database;
use PDO;

class Model
{
    protected PDO $db;

    /**
     * Initialize Database Connection.
     */
    public function __construct()
    {
        $this->db = Database::connect();
    }
}