<?php

class Page extends Model
{
    public function all(): array
    {
        return $this->db
            ->query("SELECT * FROM pages ORDER BY created_at DESC")
            ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM pages
             WHERE slug = :slug AND status = 'published'
             LIMIT 1"
        );
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM pages WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO pages (title, slug, content, status)
             VALUES (:title, :slug, :content, :status)"
        );
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;
        $stmt = $this->db->prepare(
            "UPDATE pages
             SET title=:title, slug=:slug, content=:content, status=:status
             WHERE id=:id"
        );
        $stmt->execute($data);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM pages WHERE id=:id");
        $stmt->execute(['id' => $id]);
    }
}
