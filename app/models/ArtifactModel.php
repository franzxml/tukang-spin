<?php

/**
 * Class ArtifactModel
 *
 * Handles database interactions for Artifact Sets.
 *
 * @package App\Models
 */
class ArtifactModel
{
    private string $table = 'artifact_sets';
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllArtifacts(): array
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY name ASC');
        return $this->db->resultSet();
    }

    public function addArtifact(array $data): int
    {
        $query = "INSERT INTO artifact_sets (name, bonuses, image_url) VALUES (:name, :bonuses, :image_url)";
        $this->db->query($query);
        
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('bonuses', htmlspecialchars($data['bonuses']));
        $this->db->bind('image_url', $data['image_url']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteArtifact(int $id): int
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}