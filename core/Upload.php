<?php

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/Post.php';

class PostController extends Controller
{
    /**
     * =========================
     * Список постів
     * =========================
     */
    public function index()
    {
        $postModel = new Post();
        $posts = $postModel->getAll();

        $this->view('post/index', [
            'posts' => $posts
        ]);
    }

    /**
     * =========================
     * Перегляд одного поста
     * =========================
     */
    public function show($id)
    {
        $id = (int)$id;

        if ($id <= 0) {
            http_response_code(404);
            echo 'Post not found';
            exit;
        }

        $postModel = new Post();
        $post = $postModel->getById($id);

        if (!$post) {
            http_response_code(404);
            echo 'Post not found';
            exit;
        }

        $this->view('post/show', [
            'post' => $post
        ]);
    }

    /**
     * =========================
     * Форма створення
     * =========================
     */
    public function create()
    {
        Auth::check();

        $this->view('post/create');
    }

    /**
     * =========================
     * Збереження поста
     * =========================
     */
    public function store()
    {
        Auth::check();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            exit('Invalid CSRF token');
        }

        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($title === '' || $content === '') {
            $_SESSION['error'] = 'All fields are required';
            header('Location: /post/create');
            exit;
        }

        $postModel = new Post();
        $postModel->create([
            'title'   => $title,
            'content' => $content,
            'user_id' => $_SESSION['user']['id']
        ]);

        header('Location: /post');
        exit;
    }

    /**
     * =========================
     * Форма редагування
     * =========================
     */
    public function edit($id)
    {
        Auth::check();

        $id = (int)$id;
        $postModel = new Post();
        $post = $postModel->getById($id);

        if (!$post) {
            http_response_code(404);
            exit('Post not found');
        }

        $this->view('post/edit', [
            'post' => $post
        ]);
    }

    /**
     * =========================
     * Оновлення поста
     * =========================
     */
    public function update($id)
    {
        Auth::check();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            exit('Invalid CSRF token');
        }

        $id = (int)$id;
        $title = trim($_POST['title'] ?? '');
        $content = trim($_POST['content'] ?? '');

        if ($title === '' || $content === '') {
            $_SESSION['error'] = 'All fields are required';
            header("Location: /post/edit/$id");
            exit;
        }

        $postModel = new Post();
        $postModel->update($id, [
            'title'   => $title,
            'content' => $content
        ]);

        header("Location: /post/show/$id");
        exit;
    }

    /**
     * =========================
     * Видалення поста
     * =========================
     */
    public function delete($id)
    {
        Auth::check();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit;
        }

        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            http_response_code(403);
            exit('Invalid CSRF token');
        }

        $id = (int)$id;

        $postModel = new Post();
        $postModel->delete($id);

        header('Location: /post');
        exit;
    }
}
