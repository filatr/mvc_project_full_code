<?php
session_start();

/**
 * Абсолютний шлях до кореня
 */
define('ROOT', dirname(__FILE__));

/**
 * Конфіг БД
 */
require_once ROOT . '/config/database.php';

/**
 * БАЗОВІ КЛАСИ MVC
 * ЇХ ТРЕБА ПІДКЛЮЧАТИ ЯВНО
 */
require_once ROOT . '/core/Database.php';
require_once ROOT . '/core/Model.php';

/**
 * Autoload для решти класів
 */
spl_autoload_register(function ($class) {
    $paths = [
        ROOT . '/core/' . $class . '.php',
        ROOT . '/controllers/' . $class . '.php',
        ROOT . '/models/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

/**
 * Роутинг
 */
$url = trim($_GET['url'] ?? '', '/');
$parts = explode('/', $url);

$controllerName = !empty($parts[0])
    ? ucfirst($parts[0]) . 'Controller'
    : 'HomeController';

$action = $parts[1] ?? 'index';
$param = $parts[2] ?? null;

if (!class_exists($controllerName)) {
    http_response_code(404);
    exit('Controller not found');
}

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    http_response_code(404);
    exit('Action not found');
}

$controller->$action($param);
