<?php

class HomeController
{
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->getLatest();

        View::render('post/index', [
            'posts' => $posts,
            'title' => 'Головна сторінка'
        ]);
    }
}
