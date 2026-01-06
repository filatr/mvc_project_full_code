<?php

define('ROOT', dirname(__FILE__));

require_once ROOT . '/config/config.php';
require_once ROOT . '/core/Database.php';
require_once ROOT . '/core/Model.php';
require_once ROOT . '/core/View.php';
require_once ROOT . '/core/Controller.php';
require_once ROOT . '/core/Auth.php';

$router->get('/admin/themes', 'AdminThemeController@index');
$router->get('/admin/themes/activate/{theme}', 'AdminThemeController@activate');

$router->get('/{slug}', 'PageController@show');

$router->get('/admin/pages', 'AdminPageController@index');
$router->get('/admin/pages/create', 'AdminPageController@create');
$router->post('/admin/pages/create', 'AdminPageController@create');
$router->get('/admin/pages/edit/{id}', 'AdminPageController@edit');
$router->post('/admin/pages/edit/{id}', 'AdminPageController@edit');
$router->get('/admin/pages/delete/{id}', 'AdminPageController@delete');

$router->get('/admin/media', 'AdminMediaController@index');
$router->get('/admin/media/upload', 'AdminMediaController@upload');
$router->post('/admin/media/upload', 'AdminMediaController@upload');




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
