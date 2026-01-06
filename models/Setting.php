<?php

class Setting extends Model
{
    public function get(string $key): ?string
    {
        $stmt = $this->db->prepare(
            "SELECT value FROM settings WHERE `key` = :key LIMIT 1"
        );
        $stmt->execute(['key' => $key]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['value'] ?? null;
    }

    public function set(string $key, string $value): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO settings (`key`, `value`)
             VALUES (:key, :value)
             ON DUPLICATE KEY UPDATE value = :value"
        );
        $stmt->execute([
            'key' => $key,
            'value' => $value
        ]);
    }
}
