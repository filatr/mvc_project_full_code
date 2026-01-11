<?php

class AdminpostsController
{
    public function __construct()
    {
        Auth::check();
    }

    /**
     * Список постів
     */
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->getAll();

        require ROOT . '/views/admin/posts/index.php';
    }

    /**
     * Створення поста
     */
    public function create(): void
    {
		
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Csrf::check($_POST['csrf_token'] ?? null)) {
        Flash::set('error', 'CSRF token invalid');
        header('Location: /adminposts/create');
        exit;
    }

    $postModel = new Post();
    $postModel->create([
        'title'   => $_POST['title'],
        'content' => $_POST['content'],
    ]);

    Csrf::regenerate();
    Flash::set('success', 'Пост створено');
    header('Location: /adminposts/index');
    exit;
}
exit;
        }

        require ROOT . '/views/admin/posts/create.php';
    }

    /**
     * Редагування
     */
    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $postModel = new Post();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!Csrf::check($_POST['csrf_token'] ?? null)) {
        Flash::set('error', 'CSRF token invalid');
        header('Location: /adminposts/edit?id=' . $id);
        exit;
    }

    $postModel->update($id, [
        'title'   => $_POST['title'],
        'content' => $_POST['content'],
    ]);

    Csrf::regenerate();
    Flash::set('success', 'Пост оновлено');
    header('Location: /adminposts/index');
    exit;
}


        $post = $postModel->getById($id);

        if (!$post) {
            Response::notFound('Post not found');
            return;
        }

        require ROOT . '/views/admin/posts/edit.php';
    }

    /**
     * Видалення
     */
    public function delete(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        $postModel = new Post();
        $postModel->delete($id);

        header('Location: /adminposts/index');
        exit;
    }
}
