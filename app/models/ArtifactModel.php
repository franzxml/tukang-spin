<?php

/**
 * Class ArtifactModel
 * Handles database interactions for Artifact Sets.
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

    // NEW: Count total artifact sets
    public function countArtifacts(): int
    {
        $this->db->query("SELECT COUNT(*) as count FROM " . $this->table);
        $row = $this->db->single();
        return (int) $row['count'];
    }

    public function addArtifact(array $data): int
    {
        $query = "INSERT INTO artifact_sets (name, bonus_2pc, bonus_4pc, image_url) 
                  VALUES (:name, :bonus_2pc, :bonus_4pc, :image_url)";
        
        $this->db->query($query);
        $this->db->bind('name', htmlspecialchars($data['name']));
        $this->db->bind('bonus_2pc', htmlspecialchars($data['bonus_2pc']));
        $this->db->bind('bonus_4pc', htmlspecialchars($data['bonus_4pc']));
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