<?php
/**
 * core/Controller.php
 * Базовий контролер для всіх контролерів сайту
 */

abstract class Controller
{
    /**
     * Обʼєкт View
     *
     * @var View
     */
    protected View $view;

    /**
     * Конструктор
     * Створює View для кожного контролера
     */
    public function __construct()
    {
        // Ініціалізуємо View один раз
        $this->view = new View();
    }

    /**
     * Передати змінні у View
     *
     * @param string $key
     * @param mixed  $value
     */
    protected function set(string $key, mixed $value): void
    {
        $this->view->set($key, $value);
    }

    /**
     * Рендер шаблону
     *
     * @param string $template шлях типу home/index
     */
    protected function render(string $template): void
    {
        $this->view->render($template);
    }
}
