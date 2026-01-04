<?php
declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Debug (для розробки)
|--------------------------------------------------------------------------
*/
ini_set('display_errors', '1');
error_reporting(E_ALL);

/*
|--------------------------------------------------------------------------
| Константи
|--------------------------------------------------------------------------
*/
define('ROOT', dirname(__FILE__));
define('CORE', ROOT . '/core');
define('CONTROLLERS', ROOT . '/controllers');
define('MODELS', ROOT . '/models');
define('VIEWS', ROOT . '/views');

/*
|--------------------------------------------------------------------------
| Autoload
|--------------------------------------------------------------------------
*/
spl_autoload_register(function ($class) {

    $paths = [
        CORE . '/' . $class . '.php',
        CONTROLLERS . '/' . $class . '.php',
        MODELS . '/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

/*
|--------------------------------------------------------------------------
| Router
|--------------------------------------------------------------------------
*/
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = trim($uri, '/');
$segments = $uri === '' ? [] : explode('/', $uri);

$controllerName = 'HomeController';
$actionName = 'index';
$params = [];

if (!empty($segments[0])) {
    $controllerName = ucfirst($segments[0]) . 'Controller';
}
if (!empty($segments[1])) {
    $actionName = $segments[1];
}
if (count($segments) > 2) {
    $params = array_slice($segments, 2);
}

$controllerFile = CONTROLLERS . '/' . $controllerName . '.php';

if (!file_exists($controllerFile)) {
    http_response_code(404);
    exit('Controller not found');
}

require_once $controllerFile;

$controller = new $controllerName();

if (!method_exists($controller, $actionName)) {
    http_response_code(404);
    exit('Action not found');
}

call_user_func_array([$controller, $actionName], $params);
