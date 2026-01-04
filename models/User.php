<?php

require_once ROOT . '/core/Model.php';

class User extends Model
{
    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
