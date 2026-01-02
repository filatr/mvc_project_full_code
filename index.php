<?php
/**
 * index.php
 *
 * Front Controller (MVC)
 * Єдина точка входу для всіх HTTP-запитів
 */

/**
 * =========================
 * 1. НАЛАШТУВАННЯ СЕРЕДОВИЩА
 * =========================
 */

// У продакшені не показуємо помилки користувачу
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Запуск сесії
session_start();

// Захист від session fixation
session_regenerate_id(true);

/**
 * =========================
 * 2. CSRF TOKEN
 * =========================
 */
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/**
 * =========================
 * 3. ПІДКЛЮЧЕННЯ ЯДРА MVC
 * =========================
 */
require_once __DIR__ . '/core/Database.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/View.php';
require_once __DIR__ . '/core/Auth.php';

/**
 * =========================
 * 4. SITEMAP (ОКРЕМИЙ ВИПАДОК)
 * =========================
 */
$route = $_GET['route'] ?? '';

if ($route === 'sitemap.xml') {
    require_once __DIR__ . '/controllers/SitemapController.php';
    (new SitemapController())->index();
    exit;
}

/**
 * =========================
 * 5. РОУТИНГ
 * =========================
 */

// Якщо route не передано — головна сторінка
if ($route === '') {
    require_once __DIR__ . '/controllers/HomeController.php';
    (new HomeController())->index();
    exit;
}

// Розбиваємо маршрут
$parts = explode('/', trim($route, '/'));
$controllerName = ucfirst($parts[0]) . 'Controller';
$method = $parts[1] ?? 'index';
$param = $parts[2] ?? null;

$controllerFile = __DIR__ . '/controllers/' . $controllerName . '.php';

/**
 * =========================
 * 6. ПЕРЕВІРКА КОНТРОЛЕРА
 * =========================
 */
if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo '404 - Controller not found';
    exit;
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    http_response_code(500);
    echo 'Controller class not found';
    exit;
}

$controller = new $controllerName();

/**
 * =========================
 * 7. ПЕРЕВІРКА МЕТОДУ
 * =========================
 */
if (!method_exists($controller, $method)) {
    http_response_code(404);
    echo '404 - Method not found';
    exit;
}

/**
 * =========================
 * 8. ВИКЛИК КОНТРОЛЕРА
 * =========================
 */
if ($param !== null) {
    $controller->$method($param);
} else {
    $controller->$method();
}
