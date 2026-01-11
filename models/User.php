<?php

require_once ROOT . '/core/Model.php';

class User extends Model
{
    /**
     * Знайти користувача по email
     */
    public function findByEmail(string $email): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Знайти користувача по ID
     */
    public function findById(int $id): array|false
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE id = :id LIMIT 1"
        );
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Створення адміністратора
     */
    public function createAdmin(string $email, string $password): void
    {
        $stmt = $this->db->prepare(
            "INSERT INTO users (email, password, role)
             VALUES (:email, :password, 'admin')"
        );

        $stmt->execute([
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }
}
