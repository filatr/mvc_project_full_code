<?php
/**
 * Адмін-контролер для керування записами
 */

require_once __DIR__.'/../core/Auth.php';
require_once __DIR__.'/../core/Slug.php';
require_once __DIR__.'/../models/Post.php';

class PostController extends Controller {

    /**
     * Список записів
     */
    public function actionIndex() {
        Auth::requireAdmin();

        $posts = Post::all();

        ob_start();
        require __DIR__.'/../views/admin/posts/index.php';
        $content = ob_get_clean();

        require __DIR__.'/../views/layout.php';
    }

    /**
     * Створення нового запису
     */
    public function create() {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // 1️⃣ Отримуємо дані з форми
            $title   = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');

            // 2️⃣ Генеруємо SEO-friendly slug ЗАГОЛОВКА
            // Саме ОТУТ, саме перед збереженням у БД
            $slug = Slug::make($title);

            // 3️⃣ Зберігаємо запис
            Post::create([
                'title'   => $title,
                'slug'    => $slug,
                'content' => $content
            ]);

            // 4️⃣ Переходимо назад у список
            header('Location: /admin');
            exit;
        }

        // Якщо GET — показуємо форму
        ob_start();
        require __DIR__.'/../views/admin/posts/form.php';
        $content = ob_get_clean();

        require __DIR__.'/../views/layout.php';
    }
}
