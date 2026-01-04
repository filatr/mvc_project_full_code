<?php

class HomeController
{
    public function index()
    {
        // тепер клас Post АВТОМАТИЧНО ПІДТЯГУЄТЬСЯ
        $postModel = new Post();

        $posts = $postModel->getLatestPublished();

        echo '<h1>Головна сторінка</h1>';

        foreach ($posts as $post) {
            echo '<h3>' . htmlspecialchars($post['title']) . '</h3>';
            echo '<p>' . htmlspecialchars($post['content']) . '</p>';
        }
    }
}
