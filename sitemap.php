<?php
require_once __DIR__ . '/core/Database.php';

header('Content-Type: application/xml; charset=UTF-8');

$db = Database::getInstance()->getConnection();

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

echo '<url>
    <loc>https://' . $_SERVER['HTTP_HOST'] . '/</loc>
</url>';

$posts = $db->query("SELECT id FROM posts")->fetchAll(PDO::FETCH_ASSOC);
foreach ($posts as $post) {
    echo '<url>
        <loc>https://' . $_SERVER['HTTP_HOST'] . '/post/' . $post['id'] . '</loc>
    </url>';
}

echo '</urlset>';
