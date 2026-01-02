<?php
/**
 * AdminController
 *
 * Головна сторінка адмінки (dashboard).
 * Доступна тільки для admin та editor.
 */

require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Post.php';

class AdminController
{
    /**
     * GET /admin
     */
    public function index()
    {
        // ❗ Саме ТУТ, а не в __construct
        Auth::requireAdmin();

        // Отримуємо всі записи (включно з чернетками)
        $posts = Post::getAll();

        // Підключаємо dashboard
        require_once __DIR__ . '/../views/admin/index.php';
    }
}
