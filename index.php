<?php
/**
 * index.php
 * Єдина точка входу в додаток (Front Controller)
 */

// ================================
// 1. Увімкнення виводу помилок (тільки для розробки)
// ================================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ================================
// 2. Константи шляхів
// ================================

// Абсолютний шлях до кореня проєкту
define('ROOT', __DIR__);

// Шлях до папки з кодом
define('APP_PATH', ROOT);

// ================================
// 3. Підключення базових файлів ядра
// ================================

require_once ROOT . '/core/Database.php';
require_once ROOT . '/core/Model.php';
require_once ROOT . '/core/View.php';
require_once ROOT . '/core/Controller.php';
require_once ROOT . '/core/Router.php';
require_once ROOT . '/core/Auth.php';

// ================================
// 4. Запуск роутера
// ================================

try {
    $router = new Router();
    $router->dispatch();
} catch (Throwable $e) {
    // ================================
    // 5. Глобальна обробка помилок
    // ================================
    http_response_code(500);

    echo '<h1>500 — Внутрішня помилка сервера</h1>';
    echo '<pre>' . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . '</pre>';
}
