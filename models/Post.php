<?php
/**
 * -------------------------------------------------------
 * Post Model
 * -------------------------------------------------------
 * Модель для роботи з записами (posts)
 */

require_once ROOT . '/core/Model.php';

class Post extends Model
{
    /**
     * Отримати всі опубліковані записи
     *
     * @return array
     */
    public function getPublished(): array
    {
        $sql = "
            SELECT 
                p.id,
                p.title,
                p.slug,
                p.description,
                p.image,
                p.created_at
            FROM posts p
            WHERE p.status = 'published'
            ORDER BY p.created_at DESC
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Отримати один запис по slug
     *
     * @param string $slug
     * @return array|null
     */
    public function getBySlug(string $slug): ?array
    {
        $sql = "
            SELECT 
                p.* 
            FROM posts p
            WHERE p.slug = :slug
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':slug', $slug, PDO::PARAM_STR);
        $stmt->execute();

        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        return $post ?: null;
    }

    /**
     * Створити новий запис
     *
     * @param array $data
     * @return bool
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO posts (
                title,
                slug,
                description,
                content,
                image,
                status,
                user_id,
                created_at
            ) VALUES (
                :title,
                :slug,
                :description,
                :content,
                :image,
                :status,
                :user_id,
                NOW()
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':title'       => $data['title'],
            ':slug'        => $data['slug'],
            ':description' => $data['description'],
            ':content'     => $data['content'],
            ':image'       => $data['image'] ?? null,
            ':status'      => $data['status'],
            ':user_id'     => $data['user_id'],
        ]);
    }

    /**
     * Збільшити лічильник переглядів
     *
     * @param int $id
     * @return void
     */
    public function incrementViews(int $id): void
    {
        $sql = "
            UPDATE posts 
            SET views = views + 1 
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
	/**
 * Отримати всі опубліковані записи для sitemap
 */
public function getAllPublished()
{
    $sql = "SELECT id, updated_at 
            FROM posts 
            WHERE status = 'published'";
    return $this->db->query($sql)->fetchAll();
}

}
