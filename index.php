<?php
// ================================
// index.php — Front Controller
// ================================

declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

define('ROOT', __DIR__);

// ----------------
// Session
// ----------------
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ----------------
// Autoload
// ----------------
spl_autoload_register(function ($class) {
    $paths = [
        ROOT . '/core/' . $class . '.php',
        ROOT . '/controllers/' . $class . '.php',
        ROOT . '/models/' . $class . '.php',
        ROOT . '/helpers/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// ----------------
// Core
// ----------------
require_once ROOT . '/core/Request.php';
require_once ROOT . '/core/Response.php';

// ----------------
// Routing
// ----------------
$request = new Request();

$controllerName = $request->getController();
$actionName     = $request->getAction();

$controllerClass = ucfirst($controllerName) . 'Controller';

if (!class_exists($controllerClass)) {
    Response::notFound('Controller not found');
    exit;
}

$controller = new $controllerClass();

if (!method_exists($controller, $actionName)) {
    Response::notFound('Action not found');
    exit;
}

$controller->$actionName();
