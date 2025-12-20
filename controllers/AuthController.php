<?php
/**
 * Контролер авторизації користувачів
 */

class AuthController extends Controller
{
    /**
     * Форма входу
     */
    public function login()
    {
        // Якщо вже залогінений — одразу в адмінку
        if (Auth::check()) {
            header('Location: /admin');
            exit;
        }

        $error = null;

        // Обробка форми
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // CSRF перевірка
            if (!Csrf::check($_POST['csrf'] ?? '')) {
                $error = 'Невірний CSRF-токен';
            } else {

                $username = trim($_POST['username'] ?? '');
                $password = $_POST['password'] ?? '';

                $user = User::findByUsername($username);

                if (!$user || !password_verify($password, $user['password_hash'])) {
                    $error = 'Невірний логін або пароль';
                } else {

                    // Успішний вхід
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'role' => $user['role']
                    ];

                    header('Location: /admin');
                    exit;
                }
            }
        }

        $this->view->render('auth/login', [
            'error' => $error,
            'csrf'  => Csrf::token()
        ]);
    }

    /**
     * Вихід
     */
    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}
