<?php
/**
 * Query Trait.
 *
 * Handles parameter binding and query execution.
 *
 * @package App\Core\Database
 */
trait QueryTrait {
    /**
     * Bind values to parameters.
     *
     * @param string $param Placeholder.
     * @param mixed $value Actual value.
     * @param int|null $type PDO Type.
     */
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value): $type = PDO::PARAM_INT; break;
                case is_bool($value): $type = PDO::PARAM_BOOL; break;
                case is_null($value): $type = PDO::PARAM_NULL; break;
                default: $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * Execute the prepared statement.
     *
     * @return bool Success status.
     */
    public function execute() {
        return $this->stmt->execute();
    }
}