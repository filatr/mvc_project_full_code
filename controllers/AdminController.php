<?php
/**
 * Адмін-контролер для керування постами
 */

require_once ROOT . '/core/Auth.php';
require_once ROOT . '/models/Post.php';

class AdminPostController
{
    private Post $postModel;

    public function __construct()
    {
        // Захист адмінки
        Auth::requireAdmin();

        $this->postModel = new Post();
    }

    /**
     * Список постів
     */
    public function index(): void
    {
        $posts = $this->postModel->getLatest(50);

        View::render('admin/posts/index', [
            'posts' => $posts
        ]);
    }

    /**
     * Редагування поста
     */
    public function edit(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // тут пізніше буде update
        }

        $post = $this->postModel->getById($id);

        View::render('admin/posts/edit', [
            'post' => $post
        ]);
    }
}
