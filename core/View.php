<?php
/**
 * View — відповідає за підключення шаблонів
 * та передачу змінних у HTML
 */

class View
{
    protected array $data = [];

    /**
     * Передача змінних у view
     */
    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * Рендер шаблону
     */
    public function render(string $view): void
    {
        // Робимо змінні доступними у шаблоні
        extract($this->data);

        require __DIR__ . '/../views/layout/header.php';
        require __DIR__ . '/../views/' . $view . '.php';
        require __DIR__ . '/../views/layout/footer.php';
    }
}
