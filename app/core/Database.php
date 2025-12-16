<?php
/**
 * Database Handler Class.
 *
 * Establishes PDO connection using config constants.
 *
 * @package App\Core
 */
class Database {
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    /**
     * Set up the PDO connection.
     */
    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * Prepare a query.
     *
     * @param string $sql The SQL query.
     */
    public function query($sql) {
        $this->stmt = $this->dbh->prepare($sql);
    }
    
    // Note: Bind and Execute methods moved to DatabaseTrait 
    // due to 50-line limit constraint if logic expands.
    // For now, we access stmt directly in models if needed 
    // or expand this class in the next iteration.
    public function getStmt() {
        return $this->stmt;
    }
}