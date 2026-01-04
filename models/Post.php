<?php

require_once ROOT . '/core/Model.php';

class Post extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM posts ORDER BY created_at DESC"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM posts WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO posts (title, content, created_at)
             VALUES (:title, :content, NOW())"
        );
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $stmt = $this->db->prepare(
            "UPDATE posts SET title = :title, content = :content WHERE id = :id"
        );
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare(
            "DELETE FROM posts WHERE id = :id"
        );
        $stmt->execute(['id' => $id]);
    }
}
