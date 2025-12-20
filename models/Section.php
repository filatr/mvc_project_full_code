<?php
class Section extends Model {

    public static function all(): array {
        return self::db()
            ->query("SELECT * FROM sections ORDER BY parent_id, title")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findBySlug(string $slug): ?array {
        $stmt = self::db()->prepare(
            "SELECT * FROM sections WHERE slug = :slug LIMIT 1"
        );
        $stmt->execute([':slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public static function posts(int $sectionId): array {
        $stmt = self::db()->prepare(
            "SELECT p.*
             FROM posts p
             JOIN post_section ps ON ps.post_id = p.id
             WHERE ps.section_id = :id
             ORDER BY p.created_at DESC"
        );
        $stmt->execute([':id' => $sectionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function canView(int $sectionId, string $role): bool {
        $stmt = self::db()->prepare(
            "SELECT can_view FROM section_permissions
             WHERE section_id = :sid AND role = :role"
        );
        $stmt->execute([
            ':sid' => $sectionId,
            ':role' => $role
        ]);
        return (bool)$stmt->fetchColumn();
    }
}
