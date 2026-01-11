<?php

class Flash
{
    protected static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $type, string $message): void
    {
        self::start();
        $_SESSION['flash'][$type][] = $message;
    }

    public static function get(): array
    {
        self::start();

        $messages = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);

        return $messages;
    }
}
