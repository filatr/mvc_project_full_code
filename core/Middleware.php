<?php

class Middleware
{
    public static function auth()
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }
    }

    public static function admin()
    {
        self::auth();

        if (!Auth::hasRole('admin')) {
            require_once __DIR__ . '/../controllers/ErrorController.php';
            (new ErrorController())->forbidden();
            exit;
        }
    }
}
