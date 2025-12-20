<?php
/**
 * Примітивний Router
 * Приймає path з GET та викликає відповідний контролер
 */

class Router
{
    public function dispatch(): void
    {
        $path = $_GET['path'] ?? 'post/index';
        $parts = explode('/', trim($path, '/'));

        // Контролер + метод + параметр
        $controllerName = ucfirst($parts[0]) . 'Controller';
        $action = $parts[1] ?? 'index';
        $param = $parts[2] ?? null;

        // Автопідключення контролера
        $controllerFile = ROOT_PATH . '/controllers/' . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            http_response_code(404);
            echo "Контролер не знайдено: $controllerName";
            exit;
        }
        require_once $controllerFile;

        if (!class_exists($controllerName)) {
            http_response_code(500);
            echo "Клас контролера не знайдено: $controllerName";
            exit;
        }

        $controller = new $controllerName();

        if (!method_exists($controller, $action)) {
            http_response_code(404);
            echo "Метод не знайдено: $action";
            exit;
        }

        $controller->$action($param);
    }
}
