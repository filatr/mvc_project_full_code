<?php

define('ROOT', dirname(__FILE__));

require_once ROOT . '/config/config.php';
require_once ROOT . '/core/Database.php';
require_once ROOT . '/core/Model.php';
require_once ROOT . '/core/View.php';
require_once ROOT . '/core/Controller.php';
require_once ROOT . '/core/Auth.php';

Auth::start();

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$parts = explode('/', $uri);

$controllerName = $parts[0] ?: 'home';
$actionName     = $parts[1] ?? 'index';
$param          = $parts[2] ?? null;

$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile  = ROOT . '/controllers/' . $controllerClass . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    die('Controller not found');
}

require_once $controllerFile;

$controller = new $controllerClass();

if (!method_exists($controller, $actionName)) {
    http_response_code(404);
    die('Action not found');
}

$controller->$actionName($param);
