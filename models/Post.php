<?php

class Post
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Отримати всі пости (для адмінки)
     */
    public function getAll(): array
    {
        $stmt = $this->db->query(
            'SELECT id, title, created_at 
             FROM posts 
             ORDER BY created_at DESC'
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Отримати пост по ID
     */
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM posts WHERE id = :id'
        );

        $stmt->execute(['id' => $id]);

        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        return $post ?: null;
    }

    /**
     * Створити пост
     */
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            'INSERT INTO posts (title, content, created_at)
             VALUES (:title, :content, NOW())'
        );

        return $stmt->execute([
            'title'   => $data['title'],
            'content' => $data['content'],
        ]);
    }

    /**
     * Оновити пост
     */
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE posts
             SET title = :title,
                 content = :content
             WHERE id = :id'
        );

        return $stmt->execute([
            'id'      => $id,
            'title'   => $data['title'],
            'content' => $data['content'],
        ]);
    }

    /**
     * Видалити пост
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            'DELETE FROM posts WHERE id = :id'
        );

        return $stmt->execute(['id' => $id]);
    }
}
