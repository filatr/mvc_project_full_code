<?php

require_once ROOT . '/models/Post.php';

class AdminController
{
    private Post $postModel;
    private View $view;

    public function __construct()
    {
        Auth::requireAdmin();

        $this->postModel = new Post();
        $this->view = new View();
    }

    public function index(): void
    {
        $posts = $this->postModel->getLatest(50);

        $this->view->render('admin/index', [
            'title' => 'Адмінка',
            'posts' => $posts
        ]);
    }

    public function create(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');

            if ($title === '' || $content === '') {
                $error = 'Заповніть усі поля';
            } else {
                $this->postModel->create($title, $content);
                header('Location: /admin');
                exit;
            }
        }

        $this->view->render('admin/create', [
            'title' => 'Створити пост',
            'error' => $error
        ]);
    }

    public function edit(int $id): void
    {
        $post = $this->postModel->getById($id);

        if (!$post) {
            http_response_code(404);
            echo 'Пост не знайдено';
            return;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $content = trim($_POST['content'] ?? '');

            if ($title === '' || $content === '') {
                $error = 'Усі поля обовʼязкові';
            } else {
                $this->postModel->update($id, $title, $content);
                header('Location: /admin');
                exit;
            }
        }

        $this->view->render('admin/edit', [
            'title' => 'Редагувати пост',
            'post' => $post,
            'error' => $error
        ]);
    }

    /**
     * ❌ Видалення поста
     */
    public function delete(int $id): void
    {
        $post = $this->postModel->getById($id);

        if (!$post) {
            http_response_code(404);
            echo 'Пост не знайдено';
            return;
        }

        $this->postModel->delete($id);

        header('Location: /admin');
        exit;
    }
}
