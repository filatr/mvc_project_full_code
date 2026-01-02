<?php
/**
 * HomeController
 *
 * Контролер головної сторінки сайту.
 * Відповідає ТІЛЬКИ за публічну частину (не адмінку).
 */

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Post.php';

class HomeController extends Controller
{
    /**
     * Головна сторінка
     * URL: /
     */
    public function index()
    {
        $postModel = new Post();

        // Отримуємо опубліковані записи
        $posts = $postModel->getLatestPublished();

        /**
         * SEO / META
         * WordPress-подібна логіка
         */
        $this->view->set('meta_title', 'Головна сторінка');
        $this->view->set(
            'meta_description',
            'Останні публікації та матеріали сайту'
        );
        $this->view->set('canonical', '/');

        /**
         * Передаємо дані у View
         */
        $this->view->set('posts', $posts);

        /**
         * Рендер шаблону
         * views/home/index.php
         */
        $this->view->render('home/index');
    }
}
