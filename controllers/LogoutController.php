<?php
/**
 * LogoutController
 *
 * Відповідає за вихід користувача з системи.
 */

require_once __DIR__ . '/../core/Auth.php';

class LogoutController
{
    /**
     * GET /logout
     * Завершення сесії користувача
     */
    public function index()
    {
        // Якщо користувач не залогінений — просто на головну
        if (!Auth::check()) {
            header('Location: /');
            exit;
        }

        // Повний logout
        Auth::logout();

        // Редирект на головну сторінку
        header('Location: /');
        exit;
    }
}
