<?php

require_once ROOT . '/core/Model.php';

class Post extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM posts ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function getById(int $id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $title, string $content): bool
    {
        $stmt = $this->db->prepare("
            INSERT INTO posts (title, content, created_at)
            VALUES (:title, :content, NOW())
        ");

        return $stmt->execute([
            'title'   => $title,
            'content' => $content
        ]);
    }

    public function update(int $id, string $title, string $content): bool
    {
        $stmt = $this->db->prepare("
            UPDATE posts
            SET title = :title, content = :content
            WHERE id = :id
        ");

        return $stmt->execute([
            'id'      => $id,
            'title'   => $title,
            'content' => $content
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
