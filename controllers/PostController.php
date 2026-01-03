<?php

require_once ROOT . '/models/Post.php';

class PostController
{
    private Post $postModel;
    private View $view;

    public function __construct()
    {
        $this->postModel = new Post();
        $this->view = new View();
    }

    /**
     * Перегляд поста
     */
    public function view(string $slug): void
    {
        $post = $this->postModel->getBySlug($slug);

        if (!$post) {
            http_response_code(404);
            echo 'Пост не знайдено';
            return;
        }

        $this->postModel->incrementViews((int)$post['id']);

        $this->view->render('post/view', [
            'title' => $post['title'],
            'post' => $post
        ]);
    }
}
