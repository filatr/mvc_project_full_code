<?php

class Media extends Model
{
    public function all(): array
    {
        return $this->db
            ->query("SELECT * FROM media ORDER BY created_at DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO media (filename, original_name, mime, size)
             VALUES (:filename, :original_name, :mime, :size)"
        );
        $stmt->execute($data);
    }
}
