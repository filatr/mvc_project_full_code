<?php
/**
 * core/Router.php
 * Відповідає за маршрутизацію URL → Controller → Action
 */

class Router
{
    /**
     * Controller за замовчуванням
     */
    protected string $defaultController = 'HomeController';

    /**
     * Метод за замовчуванням
     */
    protected string $defaultAction = 'index';

    /**
     * Запуск маршрутизації
     */
    public function dispatch(): void
    {
        // Отримуємо URI без GET-параметрів
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Прибираємо зайві слеші
        $uri = trim($uri, '/');

        // Розбиваємо URI на частини
        $segments = $uri === '' ? [] : explode('/', $uri);

        // ================================
        // Controller
        // ================================
        $controllerName = $this->defaultController;

        if (!empty($segments[0])) {
            $controllerName = ucfirst($segments[0]) . 'Controller';
        }

        $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)) {
            $this->show404();
            return;
        }

        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            $this->show404();
            return;
        }

        $controller = new $controllerName();

        // ================================
        // Action (метод)
        // ================================
        $action = $this->defaultAction;

        if (!empty($segments[1])) {
            $action = $segments[1];
        }

        if (!method_exists($controller, $action)) {
            $this->show404();
            return;
        }

        // ================================
        // Параметри
        // ================================
        $params = array_slice($segments, 2);

        // ================================
        // Виклик контролера
        // ================================
        call_user_func_array([$controller, $action], $params);
    }

    /**
     * 404 сторінка
     */
    protected function show404(): void
    {
        http_response_code(404);

        $errorControllerFile = ROOT . '/controllers/ErrorController.php';

        if (file_exists($errorControllerFile)) {
            require_once $errorControllerFile;

            if (class_exists('ErrorController')) {
                $controller = new ErrorController();
                $controller->notFound();
                return;
            }
        }

        echo '<h1>404 — Сторінку не знайдено</h1>';
    }
}
