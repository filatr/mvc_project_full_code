<?php

require_once ROOT . '/core/Model.php';

class Post extends Model
{
    /**
     * Отримати останні пости
     */
    public function getLatest(int $limit = 5): array
    {
        $sql = "
            SELECT *
            FROM posts
            ORDER BY created_at DESC
            LIMIT :limit
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Отримати пост по ID
     */
    public function getById(int $id): array|false
    {
        $sql = "
            SELECT *
            FROM posts
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Створити новий пост
     */
    public function create(string $title, string $content): bool
    {
        $sql = "
            INSERT INTO posts (title, content, created_at)
            VALUES (:title, :content, NOW())
        ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title'   => $title,
            ':content' => $content,
        ]);
    }

    /**
     * Оновити пост
     */
    public function update(int $id, string $title, string $content): bool
    {
        $sql = "
            UPDATE posts
            SET title = :title,
                content = :content
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':id'      => $id,
            ':title'   => $title,
            ':content' => $content,
        ]);
    }

    /**
     * Видалити пост
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM posts WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
