<?php

class View
{
    protected array $data = [];

    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    public function render(string $view, string $layout = 'main'): void
    {
        extract($this->data, EXTR_SKIP);

        ob_start();
        require ROOT . '/views/' . $view . '.php';
        $content = ob_get_clean();

        require ROOT . '/views/layouts/' . $layout . '.php';
    }
}