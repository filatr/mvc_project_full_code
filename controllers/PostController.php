<?php

class PostController
{
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->getLatest();

        View::render('post/index', [
            'posts' => $posts,
            'title' => 'Всі пости'
        ]);
    }

    public function view(string $slug): void
    {
        $postModel = new Post();
        $post = $postModel->getBySlug($slug);

        if (!$post) {
            http_response_code(404);
            exit('Post not found');
        }

        View::render('post/view', [
            'post' => $post,
            'title' => $post['title']
        ]);
    }
}
