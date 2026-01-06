<?php

require_once ROOT . '/core/Model.php';

class Category extends Model
{
    public function getAll(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM categories ORDER BY name"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBySlug(string $slug): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM categories WHERE slug = :slug LIMIT 1"
        );
        $stmt->execute(['slug' => $slug]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create(array $data): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO categories 
            (parent_id, name, slug, meta_title, meta_description)
            VALUES (:parent_id, :name, :slug, :meta_title, :meta_description)"
        );
        $stmt->execute($data);
    }

    public function update(int $id, array $data): void
    {
        $data['id'] = $id;

        $stmt = $this->db->prepare(
            "UPDATE categories SET
             parent_id = :parent_id,
             name = :name,
             slug = :slug,
             meta_title = :meta_title,
             meta_description = :meta_description
             WHERE id = :id"
        );
        $stmt->execute($data);
    }
}
