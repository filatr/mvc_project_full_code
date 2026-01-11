<?php
declare(strict_types=1);

class Request
{
    public function getController(): string
    {
        return $_GET['controller'] ?? 'main';
    }

    public function getAction(): string
    {
        return $_GET['action'] ?? 'index';
    }
}
