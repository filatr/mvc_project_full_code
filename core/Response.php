<?php
declare(strict_types=1);

class Response
{
    public static function notFound(string $message = 'Page not found'): void
    {
        http_response_code(404);
        echo $message;
        exit;
    }
}
