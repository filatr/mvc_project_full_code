<?php
/**
 * models/Post.php
 */

require_once ROOT . '/core/Model.php';

class Post extends Model
{
    /**
     * Отримати останні пости
     *
     * @param int $limit
     * @return array
     */
    public function getLatestPublished(int $limit = 5): array
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

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Отримати пост по ID
     *
     * @param int $id
     * @return array|null
     */
    public function getById(int $id): ?array
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

        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        return $post ?: null;
    }
}
