<?php
class Post extends Model {

    public static function all(): array {
        return self::db()
            ->query("SELECT * FROM posts ORDER BY created_at DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id): ?array {
        $stmt = self::db()->prepare("SELECT * FROM posts WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function create(array $data): void {
        $stmt = self::db()->prepare(
            "INSERT INTO posts (title, content, image, created_at)
             VALUES (:title, :content, :image, NOW())"
        );
        $stmt->execute([
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':image' => $data['image']
        ]);
    }

    public static function update(int $id, array $data): void {
        $stmt = self::db()->prepare(
            "UPDATE posts
             SET title = :title, content = :content, image = :image
             WHERE id = :id"
        );
        $stmt->execute([
            ':title' => $data['title'],
            ':content' => $data['content'],
            ':image' => $data['image'],
            ':id' => $id
        ]);
    }

    public static function delete(int $id): void {
        $stmt = self::db()->prepare("DELETE FROM posts WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }
}
