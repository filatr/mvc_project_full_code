<?php

class Auth
{
    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login(int $userId): void
    {
        self::start();
        $_SESSION['user_id'] = $userId;
        $_SESSION['logged_in'] = true;
    }

    public static function logout(): void
    {
        self::start();
        session_destroy();
    }

    public static function check(): bool
    {
        self::start();
        return !empty($_SESSION['logged_in']);
    }
}
