<?php

class AdminPostController extends Controller
{
    public function index(): void
    {
        Auth::requireLogin();

        $postModel = new Post();
        $posts = $postModel->getAll();

        $this->view->render('admin/index', [
            'posts' => $posts,
            'title' => 'Адмінка — пости'
        ]);
    }

    public function create(): void
    {
        Auth::requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postModel = new Post();
            $postModel->create([
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'status' => $_POST['status']
            ]);

            header('Location: /adminpost');
            exit;
        }

        $this->view->render('admin/create', [
            'title' => 'Новий пост'
        ]);
    }

    public function edit(int $id): void
    {
        Auth::requireLogin();

        $postModel = new Post();
        $post = $postModel->find($id);

        if (!$post) {
            die('Пост не знайдено');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postModel->update($id, [
                'title' => trim($_POST['title']),
                'content' => trim($_POST['content']),
                'status' => $_POST['status']
            ]);

            header('Location: /adminpost');
            exit;
        }

        $this->view->render('admin/edit', [
            'post' => $post,
            'title' => 'Редагування поста'
        ]);
    }

    public function delete(int $id): void
    {
        Auth::requireLogin();

        $postModel = new Post();
        $postModel->delete($id);

        header('Location: /adminpost');
        exit;
    }
}
