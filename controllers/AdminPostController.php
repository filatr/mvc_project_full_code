<?php

require_once ROOT . '/core/Auth.php';
require_once ROOT . '/models/Post.php';

class AdminPostController
{
    private Post $postModel;

    public function __construct()
    {
        Auth::requireAdmin();
        $this->postModel = new Post();
    }

    public function index()
    {
        $posts = $this->postModel->getAll();
        require ROOT . '/views/admin/posts/index.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postModel->create($_POST);
            header('Location: /admin/posts');
            exit;
        }

        require ROOT . '/views/admin/posts/create.php';
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->postModel->update($id, $_POST);
            header('Location: /admin/posts');
            exit;
        }

        $post = $this->postModel->find($id);
        require ROOT . '/views/admin/posts/edit.php';
    }

    public function delete($id)
    {
        $this->postModel->delete($id);
        header('Location: /admin/posts');
        exit;
    }
}
