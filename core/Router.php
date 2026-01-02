<?php

/**
 * Router — маршрутизація URL → Controller → Action
 */

class Router
{
    /**
     * Основний метод запуску роутера
     */
    public function run()
    {
        // Отримуємо URL без GET-параметрів
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = trim($uri, '/');

        // Якщо головна сторінка
        if ($uri === '') {
            $controllerName = 'HomeController';
            $actionName = 'actionIndex';
        } else {
            $parts = explode('/', $uri);

            // Контролер
            $controllerName = ucfirst($parts[0]) . 'Controller';

            // Метод (action)
            $actionName = isset($parts[1])
                ? 'action' . ucfirst($parts[1])
                : 'actionIndex';
        }

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        // Перевірка існування файлу контролера
        if (!file_exists($controllerFile)) {
            $this->error404("Контролер $controllerName не знайдено");
            return;
        }

        require_once $controllerFile;

        // Перевірка класу
        if (!class_exists($controllerName)) {
            $this->error404("Клас $controllerName не існує");
            return;
        }

        $controller = new $controllerName();

        // Перевірка методу
        if (!method_exists($controller, $actionName)) {
            $this->error404("Метод $actionName не існує");
            return;
        }

        // Виклик action
        $controller->$actionName();
    }

    /**
     * Вивід 404
     */
    private function error404($message = '')
    {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        if ($message) {
            echo "<p>$message</p>";
        }
        exit;
    }
}
