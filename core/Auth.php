<?php
/**
 * Клас авторизації та контролю доступу
 */

class Auth
{
    /**
     * Перевіряє, чи користувач увійшов у систему
     */
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Повертає поточного користувача
     */
    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Перевіряє роль користувача
     */
    public static function hasRole(string $role): bool
    {
        if (!self::check()) {
            return false;
        }

        return $_SESSION['user']['role'] === $role;
    }

    /**
     * Перевірка доступу до адмінки
     * Якщо немає доступу — 403
     */
    public static function requireAdmin(): void
    {
        if (!self::check() || !in_array($_SESSION['user']['role'], ['admin', 'editor'])) {
            http_response_code(403);
            echo 'Доступ заборонено';
            exit;
        }
    }

    /**
     * Логаут
     */
    public static function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}
