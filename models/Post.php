<?php

class Post extends Model
{
    public function getLatestPublished(): array
    {
        $sql = "
            SELECT *
            FROM posts
            WHERE is_published = 1
            ORDER BY created_at DESC
            LIMIT 10
        ";

        $stmt = $this->db->query($sql);
        return $stmt->fetchAll();
    }
}
