<?php
/**
 * Модель користувача
 */

class User extends Model
{
    protected string $table = 'users';

    public static function findByUsername(string $username): ?array
    {
        $db = Database::getInstance();

        $stmt = $db->prepare("SELECT * FROM users WHERE username = :u LIMIT 1");
        $stmt->execute(['u' => $username]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}
