<?php

define('ROOT', dirname(__FILE__));

require_once ROOT . '/core/Database.php';
require_once ROOT . '/core/Model.php';
require_once ROOT . '/core/Auth.php';

Auth::start();

$url = trim($_SERVER['REQUEST_URI'], '/');
$parts = explode('/', $url);

// ======= ROUTING =======

if ($url === '') {
    require_once ROOT . '/controllers/HomeController.php';
    (new HomeController())->index();
    exit;
}

// ---------- AUTH ----------
if ($url === 'login') {
    require_once ROOT . '/controllers/AuthController.php';
    (new AuthController())->login();
    exit;
}

if ($url === 'logout') {
    Auth::logout();
    header('Location: /');
    exit;
}

// ---------- ADMIN ----------
if ($parts[0] === 'admin') {
    require_once ROOT . '/controllers/AdminPostController.php';
    $controller = new AdminPostController();

    $action = $parts[2] ?? 'index';
    $id = $parts[3] ?? null;

    if (method_exists($controller, $action)) {
        $controller->$action($id);
    } else {
        http_response_code(404);
        echo 'Admin page not found';
    }
    exit;
}

// ---------- POSTS ----------
if ($parts[0] === 'post') {
    require_once ROOT . '/controllers/PostController.php';
    (new PostController())->view($parts[1] ?? null);
    exit;
}

// ---------- 404 ----------
http_response_code(404);
echo 'Page not found';
