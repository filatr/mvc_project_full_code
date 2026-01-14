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

        // CSRF (якщо клас вже існує)
        if (!Csrf::check($_POST['csrf_token'] ?? '')) {
            die('CSRF token mismatch');
        }

        $title   = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($title === '' || $content === '') {
            $_SESSION['flash'][] = [
                'type' => 'error',
                'text' => 'Заповни всі поля'
            ];
            header('Location: /adminposts/create');
            exit;
        }

        $postModel = new Post();
        $postModel->create([
            'title'   => $title,
            'content' => $content,
        ]);

        $_SESSION['flash'][] = [
            'type' => 'success',
            'text' => 'Пост створено'
        ];

        header('Location: /adminposts');
        exit;
    }

    // ⬅️ ОСЬ ТУТ ГОЛОВНА ЗМІНА
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
