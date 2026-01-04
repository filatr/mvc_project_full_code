<?php

class Guard
{
    public static function admin(): void
    {
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }
    }
}
