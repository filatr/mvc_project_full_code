<?php
/**
 * core/View.php
 * Відповідає за відображення (View) у MVC
 */

class View
{
    /**
     * Дані, передані з контролера у шаблон
     *
     * @var array
     */
    protected array $data = [];

    /**
     * Активний layout (загальний шаблон)
     *
     * @var string
     */
    protected string $layout = 'main';

    /**
     * Передати змінну у View
     *
     * @param string $key
     * @param mixed  $value
     */
    public function set(string $key, mixed $value): void
    {
        $this->data[$key] = $value;
    }

    /**
     * Відобразити шаблон
     *
     * @param string $template шлях типу home/index
     */
    public function render(string $template): void
    {
        // Робимо змінні доступними у шаблоні
        extract($this->data);

        // Шлях до файлу шаблону
        $templateFile = ROOT . '/views/' . $template . '.php';

        if (!file_exists($templateFile)) {
            throw new Exception('Шаблон не знайдено: ' . $template);
        }

        // Буферизація виводу шаблону
        ob_start();
        require $templateFile;
        $content = ob_get_clean();

        // Шлях до layout
        $layoutFile = ROOT . '/views/layouts/' . $this->layout . '.php';

        if (!file_exists($layoutFile)) {
            throw new Exception('Layout не знайдено: ' . $this->layout);
        }

        // Підключаємо layout
        require $layoutFile;
    }

    /**
     * Змінити layout (наприклад для адмінки)
     *
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }
}
