<?php

require_once ROOT . '/models/User.php';
require_once ROOT . '/helpers/Auth.php';

class AuthController
{
    /**
     * Форма логіну
     */
    public function login(): void
    {
        require ROOT . '/views/auth/login.php';
    }

    /**
     * Обробка логіну
     */
    public function authenticate(): void
    {
        $email    = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = 'Невірний email або пароль';
            header('Location: /login');
            exit;
        }

        Auth::login($user);
        header('Location: /admin');
        exit;
    }

    /**
     * Вихід
     */
    public function logout(): void
    {
        Auth::logout();
        header('Location: /login');
        exit;
    }
}
