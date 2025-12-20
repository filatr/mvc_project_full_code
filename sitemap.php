<?php
/**
 * Sitemap generator
 * Генерує sitemap.xml динамічно
 */

require_once __DIR__.'/config.php';
require_once __DIR__.'/core/Database.php';
require_once __DIR__.'/core/Model.php';

header('Content-Type: application/xml; charset=UTF-8');

$baseUrl = 'https://' . $_SERVER['HTTP_HOST'];

echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    <!-- Головна сторінка -->
    <url>
        <loc><?= htmlspecialchars($baseUrl, ENT_QUOTES, 'UTF-8') ?>/</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

<?php
/* ===== РОЗДІЛИ ===== */
$sections = Database::connect()
    ->query("SELECT slug, updated_at FROM sections WHERE is_public = 1")
    ->fetchAll(PDO::FETCH_ASSOC);

foreach ($sections as $section):
?>
    <url>
        <loc><?= htmlspecialchars($baseUrl.'/section/'.$section['slug'], ENT_QUOTES, 'UTF-8') ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
        <lastmod><?= date('c', strtotime($section['updated_at'] ?? 'now')) ?></lastmod>
    </url>
<?php endforeach; ?>

<?php
/* ===== ЗАПИСИ ===== */
$posts = Database::connect()
    ->query("SELECT slug, updated_at FROM posts WHERE is_published = 1")
    ->fetchAll(PDO::FETCH_ASSOC);

foreach ($posts as $post):
?>
    <url>
        <loc><?= htmlspecialchars($baseUrl.'/post/'.$post['slug'], ENT_QUOTES, 'UTF-8') ?></loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
        <lastmod><?= date('c', strtotime($post['updated_at'])) ?></lastmod>
    </url>
<?php endforeach; ?>

</urlset>
