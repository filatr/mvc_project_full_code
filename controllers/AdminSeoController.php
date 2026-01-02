<?php

/**
 * Базовий контролер для адмінки
 * Усі контролери адмін-панелі мають наслідувати його
 */

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';

class AdminController extends Controller
{
    public function __construct()
    {
        // Якщо користувач НЕ авторизований — редірект на логін
        if (!Auth::check()) {
            header('Location: /login');
            exit;
        }
    }
}
