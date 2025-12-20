<?php
class PostController extends Controller {

    public function __construct() {
        Auth::requireRole(['admin', 'editor']);
        require_once __DIR__.'/../models/Post.php';
        require_once __DIR__.'/../core/Upload.php';
    }

    public function actionIndex() {
        $posts = Post::all();
        $this->view('admin/posts/index', ['posts' => $posts]);
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Csrf::check($_POST['csrf'] ?? '');

            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $image = Upload::image($_FILES['image']);
            }

            Post::create([
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $image
            ]);

            header('Location: /admin');
            exit;
        }

        $this->view('admin/posts/form', [
            'csrf' => Csrf::token(),
            'post' => null
        ]);
    }

    public function edit() {
        $id = (int)($_GET['id'] ?? 0);
        $post = Post::find($id);

        if (!$post) {
            exit('Запис не знайдено');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Csrf::check($_POST['csrf'] ?? '');

            $image = $post['image'];
            if (!empty($_FILES['image']['name'])) {
                $image = Upload::image($_FILES['image']);
            }

            Post::update($id, [
                'title' => $_POST['title'],
                'content' => $_POST['content'],
                'image' => $image
            ]);

            header('Location: /admin');
            exit;
        }

        $this->view('admin/posts/form', [
            'csrf' => Csrf::token(),
            'post' => $post
        ]);
    }

    public function delete() {
        Post::delete((int)$_GET['id']);
        header('Location: /admin');
    }
}
