<?php
/**
 * -------------------------------------------------------
 * Controller — базовий клас контролерів
 * -------------------------------------------------------
 */

class Controller
{
    /**
     * Рендер view-файлу
     *
     * @param string $view   шлях до view (без .php)
     * @param array  $data   дані для передачі у view
     */
    protected function view(string $view, array $data = []): void
    {
        // Робимо ключі масиву змінними
        extract($data, EXTR_SKIP);

        // Повний шлях до view-файлу
        $viewFile = ROOT . '/views/' . $view . '.php';

        if (!file_exists($viewFile)) {
            die('View не знайдено: ' . htmlspecialchars($viewFile));
        }

        require $viewFile;
    }
}
