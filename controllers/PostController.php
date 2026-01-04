<?php

define('ROOT', dirname(__FILE__));

require_once ROOT . '/config/database.php';
require_once ROOT . '/core/Database.php';
require_once ROOT . '/core/Model.php';
require_once ROOT . '/core/View.php';
require_once ROOT . '/core/Controller.php';

// Простий автолоадер
spl_autoload_register(function ($class) {
    $paths = [
        ROOT . '/controllers/' . $class . '.php',
        ROOT . '/models/' . $class . '.php',
        ROOT . '/core/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Router (мінімальний)
$controllerName = 'HomeController';
$action = 'index';

if (isset($_GET['url'])) {
    $parts = explode('/', trim($_GET['url'], '/'));
    $controllerName = ucfirst($parts[0]) . 'Controller';
    $action = $parts[1] ?? 'index';
}

if (!class_exists($controllerName)) {
    die("Controller not found: $controllerName");
}

$controller = new $controllerName();

if (!method_exists($controller, $action)) {
    die("Action not found: $action");
}

$controller->$action();
