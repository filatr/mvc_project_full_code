<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/Post.php';

class PostController extends Controller
{
    public function view($id): void
    {
        $postModel = new Post();
        $post = $postModel->getById((int)$id);

        if (!$post) {
            http_response_code(404);
            die('Запис не знайдено');
        }

        $this->view->set('post', $post);

        $this->view->set(
            'meta_title',
            $post['meta_title'] ?: $post['title']
        );

        $this->view->set(
            'meta_description',
            $post['meta_description'] ?: mb_substr(strip_tags($post['content']), 0, 160)
        );

        $this->view->render('post/view');
    }
}
