<?php

require_once ROOT . '/core/Model.php';

class Page extends Model
{
    public function getBySlug(string $slug): ?array
    {
        $sql = "
            SELECT *
            FROM pages
            WHERE slug = :slug
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['slug' => $slug]);

        $page = $stmt->fetch(PDO::FETCH_ASSOC);

        return $page ?: null;
    }
}
