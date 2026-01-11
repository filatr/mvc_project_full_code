<?php
// ================================
// index.php — Front Controller
// ================================

declare(strict_types=1);

ini_set('display_errors', '1');
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

// ----------------
// Autoload
// ----------------
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

// ----------------
// Router (simple)
// ----------------
require_once ROOT . '/core/Request.php';
require_once ROOT . '/core/Response.php';

$request = new Request();

$controllerName = $request->getController();
$actionName     = $request->getAction();

$controllerClass = ucfirst($controllerName) . 'Controller';

if (!class_exists($controllerClass)) {
    Response::notFound('Controller not found');
}

$controller = new $controllerClass();

if (!method_exists($controller, $actionName)) {
    Response::notFound('Action not found');
}

$controller->$actionName();


$controller = new $controllerClass();

if (!method_exists($controller, $actionName)) {
    die('Action not found');
}

$controller->$actionName();
