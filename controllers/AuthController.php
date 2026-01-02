<?php

/**
 * AuthController
 *
 * Відповідає за:
 * - показ форми логіну
 * - обробку логіну
 * - вихід із системи
 */

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Csrf.php';
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    /**
     * Показ форми логіну
     * URL: GET /login
     */
    public function loginForm()
    {
        // Якщо користувач вже авторизований — не пускаємо на login
        if (Auth::check(false)) {
            header('Location: /admin');
            exit;
        }

        require __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Обробка логіну
     * URL: POST /login
     */
    public function login()
    {
        // Перевірка CSRF
        if (!Csrf::check($_POST['csrf_token'] ?? '')) {
            die('CSRF-помилка');
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            die('Заповніть усі поля');
        }

        // Отримуємо користувача з БД
        $user = User::findByUsername($username);

        if (!$user) {
            die('Користувача не знайдено');
        }

        // Перевірка пароля
        if (!password_verify($password, $user['password_hash'])) {
            die('Невірний пароль');
        }

        // Якщо користувач заблокований
        if ($user['is_blocked']) {
            die('Обліковий запис заблоковано');
        }

        // Авторизація
        Auth::login($user);

        // Успішний вхід → в адмінку
        header('Location: /admin');
        exit;
    }

    /**
     * Вихід із системи
     * URL: GET /logout
     */
    public function logout()
    {
        Auth::logout();

        header('Location: /login');
        exit;
    }
}
