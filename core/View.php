<?php

class View
{
    private string $theme;

    public function __construct()
    {
        $config = require ROOT . '/config/config.php';
        $this->theme = $config['theme'] ?? 'default';
    }

    public function render(string $view, array $data = []): void
    {
        extract($data);

        $viewFile = ROOT . '/views/' . $view . '.php';
        $layoutFile = ROOT . '/themes/' . $this->theme . '/layout.php';

        if (!file_exists($viewFile)) {
            throw new Exception("View не знайдено: $viewFile");
        }

        if (!file_exists($layoutFile)) {
            throw new Exception("Layout не знайдено: $layoutFile");
        }

        ob_start();
        require $viewFile;
        $content = ob_get_clean();

        require $layoutFile;
    }
}
