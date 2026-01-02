<?php
/**
 * -------------------------------------------------------
 * User model
 * -------------------------------------------------------
 * Робота з таблицею users
 */

require_once ROOT . '/core/Database.php';

class User
{
    /**
     * PDO-зʼєднання
     */
    private PDO $db;

    public function __construct()
    {
        // Отримуємо зʼєднання з БД
        $this->db = Database::getInstance();
    }

    /**
     * Пошук користувача за username
     *
     * @param string $username
     * @return array|null
     */
    public function findByUsername(string $username): ?array
    {
        $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user ?: null;
    }

    /**
     * Пошук користувача за ID
     */
    public function findById(int $id): ?array
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    /**
     * Створення нового користувача
     */
    public function create(array $data): bool
    {
        $sql = "
            INSERT INTO users (username, email, password_hash, role)
            VALUES (:username, :email, :password_hash, :role)
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':username'      => $data['username'],
            ':email'         => $data['email'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':role'          => $data['role'] ?? 'user',
        ]);
    }
}
