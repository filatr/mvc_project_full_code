<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/Post.php';

class PostController extends Controller
{
    public function view(string $slug): void
    {
        $postModel = new Post();
        $post = $postModel->getBySlug($slug);

        if (!$post) {
            http_response_code(404);
            die('Сторінку не знайдено');
        }

        $this->view->set('title', $post['title']);
        $this->view->set(
            'description',
            mb_substr(strip_tags($post['content']), 0, 160)
        );

        $this->view->render('post/view', [
            'post' => $post
        ]);
    }
}
