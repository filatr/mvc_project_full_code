<?php

class Csrf
{
    /**
     * Генерує CSRF-токен і зберігає його в сесії
     */
    public static function token(): string
    {
        if (empty($_SESSION['_csrf'])) {
            $_SESSION['_csrf'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['_csrf'];
    }

    /**
     * Перевіряє CSRF-токен з форми
     */
    public static function check(?string $token): bool
    {
        if (
            empty($_SESSION['_csrf']) ||
            empty($token) ||
            !hash_equals($_SESSION['_csrf'], $token)
        ) {
            return false;
        }

        return true;
    }
}
