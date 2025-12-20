<?php
require_once __DIR__.'/config.php';
require_once __DIR__.'/core/Database.php';
require_once __DIR__.'/core/Model.php';
require_once __DIR__.'/core/Controller.php';
require_once __DIR__.'/core/Csrf.php';
require_once __DIR__.'/core/Auth.php';
require_once __DIR__.'/core/Security.php';
Security::headers();


$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $uri);

/* Головна */
if ($uri === '') {
    require_once __DIR__.'/controllers/PostController.php';
    (new PostController())->actionIndex();
    exit;
}

/* Адмінка */
if ($parts[0] === 'admin') {
    require_once __DIR__.'/controllers/admin/PostController.php';
    $controller = new PostController();
    $action = $parts[1] ?? 'index';

    match ($action) {
        'create' => $controller->create(),
        'edit'   => $controller->edit(),
        'delete' => $controller->delete(),
        default  => $controller->actionIndex(),
    };
    exit;
}

/* Розділ */
if ($parts[0] === 'section' && !empty($parts[1])) {
    require_once __DIR__.'/controllers/SectionController.php';
    (new SectionController())->view($parts[1]);
    exit;
}

/* Запис */
if ($parts[0] === 'post' && !empty($parts[1])) {
    require_once __DIR__.'/controllers/PostController.php';
    (new PostController())->viewBySlug($parts[1]);
    exit;
}

http_response_code(404);
echo '404';
