<?php

class ErrorController
{
    public function notFound()
    {
        http_response_code(404);

        // Показуємо view 404
        require __DIR__ . '/../views/errors/404.php';
    }
}
