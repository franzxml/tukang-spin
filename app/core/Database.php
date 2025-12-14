<?php

/**
 * Class Database
 *
 * A PDO database wrapper class to handle database connections and queries safely.
 * Implements the singleton pattern for connection efficiency (optional) or direct instantiation.
 *
 * @package App\Core
 */
class Database
{
    /** @var string $host Database host address */
    private string $host = DB_HOST;

    /** @var string $user Database username */
    private string $user = DB_USER;

    /** @var string $pass Database password */
    private string $pass = DB_PASS;

    /** @var string $db_name Database name */
    private string $db_name = DB_NAME;

    /** @var PDO $dbh Database Handler */
    private PDO $dbh;

    /** @var PDOStatement $stmt Query Statement */
    private PDOStatement $stmt;

    /**
     * Database constructor.
     * Establishes the database connection using PDO options.
     */
    public function __construct()
    {
        // Data Source Name
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;

        $options = [
            PDO::ATTR_PERSISTENT => true, // Keep connection open for performance
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Throw exceptions on errors
        ];

        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            // In a production environment, log this instead of echoing
            die("Database Connection Error: " . $e->getMessage());
        }
    }

    /**
     * Prepares a SQL query.
     *
     * @param string $query The SQL query string.
     * @return void
     */
    public function query(string $query): void
    {
        $this->stmt = $this->dbh->prepare($query);
    }

    /**
     * Binds a value to a parameter in the prepared statement.
     *
     * @param string $param The placeholder parameter (e.g., :id).
     * @param mixed $value The value to bind.
     * @param int|null $type The PDO data type (optional).
     * @return void
     */
    public function bind(string $param, mixed $value, ?int $type = null): void
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Executes the prepared statement.
     *
     * @return bool True on success, false on failure.
     */
    public function execute(): bool
    {
        return $this->stmt->execute();
    }

    /**
     * Executes the query and returns a result set as an array of objects.
     *
     * @return array The result set.
     */
    public function resultSet(): array
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Executes the query and returns a single record.
     *
     * @return mixed The single record (array) or false if not found.
     */
    public function single(): mixed
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    /**
     * Returns the number of rows affected by the last SQL statement.
     * * @return int Row count.
     */
    public function rowCount(): int 
    {
        return $this->stmt->rowCount();
    }
}