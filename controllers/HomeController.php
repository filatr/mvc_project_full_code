<?php
/**
 * controllers/HomeController.php
 */

require_once ROOT . '/core/Controller.php';
require_once ROOT . '/models/Post.php';

class HomeController extends Controller
{
    public function index(): void
    {
        $postModel = new Post();
        $posts = $postModel->getLatestPublished(5);

        $this->view->set('posts', $posts);
        $this->view->render('home/index');
    }
}
