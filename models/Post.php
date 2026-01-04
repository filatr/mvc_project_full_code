<?php
/**
 * Модель Post
 * Повноцінна модель для роботи з постами
 */

require_once ROOT . '/core/Model.php';

class Post extends Model
{
    /**
     * Отримати всі пости (для адмінки)
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        return $this->db->query($sql)->fetchAll();
    }

    /**
     * Отримати останні пости (для фронту)
     */
    public function getLatest(int $limit = 10): array
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
        $sql = "SELECT * FROM posts WHERE id = :id LIMIT 1";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Створити пост
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO posts (title, content, created_at)
            VALUES (:title, :content, NOW())
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'title'   => $data['title'],
            'content' => $data['content']
        ]);
    }

    /**
     * Оновити пост
     */
    public function update(int $id, array $data): bool
    {
        $sql = "
            UPDATE posts
            SET title = :title,
                content = :content
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'id'      => $id,
            'title'   => $data['title'],
            'content' => $data['content']
        ]);
    }

    /**
     * Видалити пост
     */
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM posts WHERE id = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
