<?php
/**
 * Контролер авторизації
 * Відповідає за:
 *  - логін
 *  - логаут
 */

require_once ROOT . '/models/User.php';
require_once ROOT . '/core/Auth.php';

class AuthController
{
    /**
     * Сторінка логіну
     */
    public function login(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {
                $error = 'Заповніть усі поля';
            } else {
                $userModel = new User();
                $user = $userModel->findByUsername($username);

                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['user'] = [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'role'     => $user['role']
                    ];

                    header('Location: /admin/posts');
                    exit;
                }

                $error = 'Невірний логін або пароль';
            }
        }

        require ROOT . '/views/auth/login.php';
    }

    /**
     * Вихід із системи
     */
    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
