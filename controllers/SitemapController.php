<?php
/**
 * SitemapController
 * Відповідає за генерацію sitemap.xml
 */

require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Post.php';

class SitemapController extends Controller
{
    public function index()
    {
        // Заголовок XML
        header('Content-Type: application/xml; charset=UTF-8');

        $postModel = new Post();
        $posts = $postModel->getAllPublished();

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Головна сторінка
        echo $this->urlBlock('/', 'daily', '1.0');

        foreach ($posts as $post) {
            echo $this->urlBlock(
                '/post/' . $post['id'],
                'weekly',
                '0.8',
                $post['updated_at']
            );
        }

        echo '</urlset>';
    }

    /**
     * Формування одного <url>
     */
    private function urlBlock($loc, $freq, $priority, $lastmod = null)
    {
        $baseUrl = $this->getBaseUrl();

        $xml  = '<url>';
        $xml .= '<loc>' . htmlspecialchars($baseUrl . $loc) . '</loc>';
        if ($lastmod) {
            $xml .= '<lastmod>' . date('Y-m-d', strtotime($lastmod)) . '</lastmod>';
        }
        $xml .= '<changefreq>' . $freq . '</changefreq>';
        $xml .= '<priority>' . $priority . '</priority>';
        $xml .= '</url>';

        return $xml;
    }

    /**
     * Визначення базового URL
     */
    private function getBaseUrl()
    {
        return (isset($_SERVER['HTTPS']) ? 'https' : 'http')
            . '://' . $_SERVER['HTTP_HOST'];
    }
}
