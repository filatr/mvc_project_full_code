<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/Post.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->getLatest();

        $this->view->set('posts', $posts);

        $this->view->set('meta_title', 'Головна сторінка');
        $this->view->set('meta_description', 'Опис головної сторінки');

        $this->view->render('home/index');
    }
}
