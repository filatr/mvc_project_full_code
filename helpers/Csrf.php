<?php

class Csrf
{
    protected static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Отримати або згенерувати токен
     */
    public static function token(): string
    {
        self::start();

        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    /**
     * Перевірка токена
     */
    public static function check(?string $token): bool
    {
        self::start();

        if (empty($token) || empty($_SESSION['csrf_token'])) {
            return false;
        }

        return hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Очищення токена (опціонально)
     */
    public static function regenerate(): void
    {
        self::start();
        unset($_SESSION['csrf_token']);
    }
}
