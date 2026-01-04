<?php

/**
 * Контролер авторизації
 * Відповідає за:
 *  - логін
 *  - логаут
 *  - перевірку доступу
 */

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/User.php';

class AuthController extends Controller
{
    /**
     * Форма логіну + обробка логіну
     */
    public function login(): void
    {
        // Якщо користувач вже авторизований — не пускаємо на логін
        if (!empty($_SESSION['user'])) {
            header('Location: /admin');
            exit;
        }

        $error = null;

        // Якщо форма відправлена
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $login = trim($_POST['login'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($login === '' || $password === '') {
                $error = 'Заповніть всі поля';
            } else {
                $userModel = new User();
                $user = $userModel->findByLoginOrEmail($login);

                if (!$user) {
                    $error = 'Користувача не знайдено';
                } elseif (!password_verify($password, $user['password_hash'])) {
                    $error = 'Невірний пароль';
                } elseif ((int)$user['is_blocked'] === 1) {
                    $error = 'Обліковий запис заблоковано';
                } else {
                    // Успішна авторизація
                    $_SESSION['user'] = [
                        'id'       => $user['id'],
                        'username' => $user['username'],
                        'role'     => $user['role']
                    ];

                    // Оновлюємо дату останнього входу
                    $userModel->updateLastLogin($user['id']);

                    header('Location: /admin');
                    exit;
                }
            }
        }

        // Відображаємо форму логіну
        $this->view->render('auth/login', [
            'title' => 'Вхід',
            'error' => $error
        ]);
    }

    /**
     * Вихід з системи
     */
    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
        exit;
    }

    /**
     * Перевірка — чи авторизований користувач
     * Використовується в адмін-контролерах
     */
    public static function check(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }

    /**
     * Перевірка ролі користувача
     */
    public static function checkRole(string $role): void
    {
        self::check();

        if ($_SESSION['user']['role'] !== $role) {
            header('HTTP/1.0 403 Forbidden');
            echo 'Доступ заборонено';
            exit;
        }
    }
}
