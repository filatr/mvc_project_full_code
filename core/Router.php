<?php

class Router
{
    private array $routes = [];

    public function get(string $pattern, callable|array $callback): void
    {
        $this->routes['GET'][] = [$pattern, $callback];
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes[$method] ?? [] as [$pattern, $callback]) {

            $pattern = '#^' . preg_replace('#\{([\w]+)\}#', '([^/]+)', $pattern) . '$#';

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);

                if (is_array($callback)) {
                    [$controller, $method] = $callback;
                    $controller = new $controller();
                    $controller->$method(...$matches);
                } else {
                    call_user_func_array($callback, $matches);
                }
                return;
            }
        }

        http_response_code(404);
        require ROOT . '/views/errors/404.php';
        exit;
    }
}
