<?php

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/Page.php';

class PageController extends Controller
{
    public function show(string $slug): void
    {
        $pageModel = new Page();
        $page = $pageModel->getBySlug($slug);

        if (!$page) {
            header("HTTP/1.0 404 Not Found");
            echo 'Сторінку не знайдено';
            return;
        }

        $this->view->render('page/show', [
            'title' => $page['meta_title'] ?: $page['title'],
            'meta_description' => $page['meta_description'],
            'page' => $page
        ]);
    }
}
