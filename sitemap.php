<?php
/**
 * Динамічний sitemap.xml
 * 
 * Генерується автоматично з БД
 * Формат відповідає стандарту Google
 */

require_once __DIR__ . '/core/Autoloader.php';

use Core\Database;
use Models\Post;

// XML-заголовок
header('Content-Type: application/xml; charset=utf-8');

// Базовий URL сайту
$baseUrl = 'https://' . $_SERVER['HTTP_HOST'];

// Отримуємо всі публічні пости
$db = Database::getInstance();
$stmt = $db->query("
    SELECT slug, updated_at 
    FROM posts 
    ORDER BY updated_at DESC
");

$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Початок XML
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Головна сторінка -->
    <url>
        <loc><?= $baseUrl ?>/</loc>
        <lastmod><?= date('Y-m-d') ?></lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Пости -->
    <?php foreach ($posts as $post): ?>
        <url>
            <loc><?= $baseUrl ?>/post/<?= htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8') ?></loc>
            <lastmod><?= date('Y-m-d', strtotime($post['updated_at'])) ?></lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.8</priority>
        </url>
    <?php endforeach; ?>

</urlset>
