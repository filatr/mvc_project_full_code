<?php
/**
 * core/View.php
 */

class View
{
    private array $data = [];

    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function render(string $viewPath): void
    {
        extract($this->data);
        require ROOT . '/views/' . $viewPath . '.php';
    }
}
