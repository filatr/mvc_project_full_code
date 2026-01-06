<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/core/Auth.php';
require_once ROOT . '/models/Post.php';

class AdminPostController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Auth::isAdmin()) {
            http_response_code(403);
            die('Доступ заборонено');
        }
    }

    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->getAll();

        $this->view->set('posts', $posts);
        $this->view->render('admin/posts/index');
    }

    public function create(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postModel = new Post();

            $postModel->create([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
            ]);

            header('Location: /adminpost/index');
            exit;
        }

        $this->view->render('admin/posts/create');
    }

    public function edit($id): void
    {
        $postModel = new Post();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postModel->update($id, [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
            ]);

            header('Location: /adminpost/index');
            exit;
        }

        $post = $postModel->getById($id);

        $this->view->set('post', $post);
        $this->view->render('admin/posts/edit');
    }

    public function delete($id): void
    {
        $postModel = new Post();
        $postModel->delete($id);

        header('Location: /adminpost/index');
        exit;
    }
}
