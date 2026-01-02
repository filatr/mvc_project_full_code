<?php
/**
 * -------------------------------------------------------
 * Auth — клас авторизації та контролю доступу
 * -------------------------------------------------------
 */

class Auth
{
    /**
     * Перевіряє, чи користувач залогінений
     */
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Повертає дані поточного користувача
     */
    public static function user(): ?array
    {
        return $_SESSION['user'] ?? null;
    }

    /**
     * Перевірка ролі користувача
     *
     * @param string $role
     */
    public static function hasRole(string $role): bool
    {
        if (!self::check()) {
            return false;
        }

        return $_SESSION['user']['role'] === $role;
    }

    /**
     * Вимагає авторизацію
     * Якщо не залогінений — редірект на /login
     */
    public static function requireLogin(): void
    {
        if (!self::check()) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Вимагає роль адміністратора
     */
    public static function requireAdmin(): void
    {
        self::requireLogin();

        if ($_SESSION['user']['role'] !== 'admin') {
            http_response_code(403);
            echo '<h1>403 Доступ заборонено</h1>';
            exit;
        }
    }

    /**
     * Авторизація користувача
     *
     * @param array $user
     */
    public static function login(array $user): void
    {
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'username' => $user['username'],
            'role'     => $user['role'],
        ];
    }

    /**
     * Вихід користувача
     */
    public static function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();

        header('Location: /login');
        exit;
    }
}
