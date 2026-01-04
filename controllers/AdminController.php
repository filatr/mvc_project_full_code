<?php

require_once ROOT . '/models/Post.php';

class AdminPostController
{
    private Post $postModel;

    public function __construct()
    {
        $this->postModel = new Post();
    }

    /**
     * Список постів (admin)
     */
    public function index()
    {
        $posts = $this->postModel->getAll();

        require ROOT . '/views/admin/posts/index.php';
    }

    /**
     * Створення поста
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            $this->postModel->create($title, $content);

            header('Location: /admin/posts');
            exit;
        }

        require ROOT . '/views/admin/posts/create.php';
    }

    /**
     * Редагування поста
     */
    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);

            $this->postModel->update($id, $title, $content);

            header('Location: /admin/posts');
            exit;
        }

        $post = $this->postModel->getById($id);

        require ROOT . '/views/admin/posts/edit.php';
    }

    /**
     * Видалення поста
     */
    public function delete($id)
    {
        $this->postModel->delete($id);

        header('Location: /admin/posts');
        exit;
    }
}
