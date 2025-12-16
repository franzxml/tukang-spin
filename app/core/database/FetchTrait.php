<?php
/**
 * Fetch Trait.
 *
 * Handles fetching results from statements.
 *
 * @package App\Core\Database
 */
trait FetchTrait {
    /**
     * Get result set as array of objects.
     *
     * @return array Result set.
     */
    public function resultSet() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Get single record as object.
     *
     * @return object Single record.
     */
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get row count.
     *
     * @return int Number of rows.
     */
    public function rowCount() {
        return $this->stmt->rowCount();
    }
}