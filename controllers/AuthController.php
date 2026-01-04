<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/User.php';
require_once ROOT . '/core/Auth.php';

class AuthController extends Controller
{
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email    = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                Auth::login($user);
                header('Location: /admin');
                exit;
            }

            $this->view->set('error', 'Невірний email або пароль');
        }

        $this->view->render('auth/login');
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
