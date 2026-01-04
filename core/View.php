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

        $viewFile = ROOT . '/views/' . $view . '.php';
        $layoutFile = ROOT . '/views/layouts/' . $layout . '.php';

        if (!file_exists($viewFile)) {
            die("View not found: $viewFile");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        if (file_exists($layoutFile)) {
            require $layoutFile;
        } else {
            echo $content;
        }
    }
}
