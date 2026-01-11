<?php

class Auth
{
    /**
     * Запуск сесії (один раз)
     */
    protected static function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Логін користувача
     */
    public static function login(array $user): void
    {
        self::startSession();

        $_SESSION['user'] = [
            'id'    => $user['id'],
            'email' => $user['email'],
            'role'  => $user['role'],
        ];
    }

    /**
     * Вихід
     */
    public static function logout(): void
    {
        self::startSession();

        unset($_SESSION['user']);
        session_destroy();
    }

    /**
     * Перевірка авторизації
     * Якщо ні — редірект на /login
     */
    public static function check(): void
    {
        self::startSession();

        if (empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Поточний користувач
     */
    public static function user(): ?array
    {
        self::startSession();

        return $_SESSION['user'] ?? null;
    }

    /**
     * Перевірка чи адмін
     */
    public static function isAdmin(): bool
    {
        self::startSession();

        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }
}