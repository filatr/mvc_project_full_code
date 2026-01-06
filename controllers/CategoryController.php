<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/Category.php';
require_once ROOT . '/models/Post.php';

class CategoryController extends Controller
{
    public function index($slug): void
    {
        $categoryModel = new Category();
        $postModel = new Post();

        $category = $categoryModel->getBySlug($slug);

        if (!$category) {
            http_response_code(404);
            die('Категорію не знайдено');
        }

        $posts = $postModel->getByCategory($category['id']);

        $this->view->set('category', $category);
        $this->view->set('posts', $posts);

        $this->view->set(
            'meta_title',
            $category['meta_title'] ?: $category['name']
        );

        $this->view->set(
            'meta_description',
            $category['meta_description'] ?: 'Матеріали розділу ' . $category['name']
        );

        $this->view->render('category/index');
    }
}
