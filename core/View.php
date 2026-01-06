<?php

class View
{
    protected string $theme;
    protected array $data = [];

    public function __construct()
    {
        $config = require ROOT . '/config/app.php';
        $this->theme = $config['theme'];
    }

    // Передача даних у шаблон
    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    // Рендер сторінки
    public function render(string $view, string $layout = 'main'): void
    {
        extract($this->data);

        $viewFile = ROOT . "/themes/{$this->theme}/views/{$view}.php";
        $layoutFile = ROOT . "/themes/{$this->theme}/views/layouts/{$layout}.php";

        if (!file_exists($viewFile)) {
            die("View {$view} не знайдено");
        }

        if (!file_exists($layoutFile)) {
            die("Layout {$layout} не знайдено");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }
}
