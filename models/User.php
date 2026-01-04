<?php

/**
 * Модель User
 * Працює з таблицею `users`
 */

require_once ROOT . '/core/Model.php';

class User extends Model
{
    /**
     * Пошук користувача по логіну або email
     */
    public function findByLoginOrEmail(string $login): ?array
    {
        $sql = "
            SELECT *
            FROM users
            WHERE username = :login OR email = :login
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':login', $login, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Оновлення дати останнього входу
     */
    public function updateLastLogin(int $userId): void
    {
        $sql = "
            UPDATE users
            SET last_login = NOW()
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Створення нового користувача
     * (пізніше — через адмінку)
     */
    public function create(array $data): int
    {
        $sql = "
            INSERT INTO users (username, email, password_hash, role)
            VALUES (:username, :email, :password_hash, :role)
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':username'      => $data['username'],
            ':email'         => $data['email'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role'          => $data['role'] ?? 'user',
        ]);

        return (int)$this->db->lastInsertId();
    }

    /**
     * Отримати користувача по ID
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM users WHERE id = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Перевірка, чи існує користувач з таким email
     */
    public function existsByEmail(string $email): bool
    {
        $stmt = $this->db->prepare(
            "SELECT id FROM users WHERE email = :email LIMIT 1"
        );
        $stmt->execute([':email' => $email]);

        return (bool)$stmt->fetchColumn();
    }
}
