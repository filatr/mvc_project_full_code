<?php

class Post extends Model
{
    /**
     * Отримати список постів
     */
    public function getLatest(int $limit = 10): array
    {
        $stmt = $this->db->prepare("
            SELECT id, title, slug, created_at
            FROM posts
            ORDER BY created_at DESC
            LIMIT :limit
        ");

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    /**
     * Отримати пост по slug
     */
    public function getBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM posts
            WHERE slug = :slug
            LIMIT 1
        ");

        $stmt->execute([':slug' => $slug]);
        $post = $stmt->fetch();

        return $post ?: null;
    }

    /**
     * Отримати пост по ID
     */
    public function getById(int $id): ?array
    {
        $stmt = $this->db->prepare("
            SELECT *
            FROM posts
            WHERE id = :id
            LIMIT 1
        ");

        $stmt->execute([':id' => $id]);
        return $stmt->fetch() ?: null;
    }

    /**
     * Створення поста
     */
    public function create(string $title, string $content): void
    {
        $slug = $this->generateSlug($title);

        $stmt = $this->db->prepare("
            INSERT INTO posts (title, slug, content, created_at)
            VALUES (:title, :slug, :content, NOW())
        ");

        $stmt->execute([
            ':title' => $title,
            ':slug' => $slug,
            ':content' => $content
        ]);
    }

    /**
     * Оновлення поста
     */
    public function update(int $id, string $title, string $content): void
    {
        $slug = $this->generateSlug($title);

        $stmt = $this->db->prepare("
            UPDATE posts
            SET title = :title,
                slug = :slug,
                content = :content
            WHERE id = :id
        ");

        $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':slug' => $slug,
            ':content' => $content
        ]);
    }

    /**
     * Збільшити лічильник переглядів
     */
    public function incrementViews(int $id): void
    {
        $this->db->prepare("
            UPDATE posts
            SET views = views + 1
            WHERE id = :id
        ")->execute([':id' => $id]);
    }

    /**
     * Генерація slug
     */
    private function generateSlug(string $text): string
    {
        $text = mb_strtolower($text, 'UTF-8');
        $text = preg_replace('/[^a-zа-я0-9]+/u', '-', $text);
        $text = trim($text, '-');

        return $text ?: uniqid('post-');
    }
}
