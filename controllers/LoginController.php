<?php
/**
 * -------------------------------------------------------
 * LoginController
 * -------------------------------------------------------
 * Контролер авторизації користувачів
 */

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/core/Auth.php';
require_once ROOT . '/models/User.php';

class LoginController extends Controller
{
    /**
     * Показ сторінки логіну
     * URL: /login
     */
    public function actionIndex(): void
    {
        $this->view('login/index');
    }

    /**
     * Обробка POST-запиту логіну
     * URL: /login/login
     */
    public function actionLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /login');
            exit;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($username === '' || $password === '') {
            $_SESSION['error'] = 'Заповніть всі поля';
            header('Location: /login');
            exit;
        }

        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $_SESSION['error'] = 'Невірний логін або пароль';
            header('Location: /login');
            exit;
        }

        // Успішна авторизація
        Auth::login($user);

        header('Location: /admin');
        exit;
    }

    /**
     * Вихід користувача
     * URL: /login/logout
     */
    public function actionLogout(): void
    {
        Auth::logout();
    }
}
