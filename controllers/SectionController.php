<?php
class SectionController extends Controller {

    public function view(string $slug) {
        require_once __DIR__.'/../models/Section.php';

        $section = Section::findBySlug($slug);
        if (!$section) {
            http_response_code(404);
            exit('Розділ не знайдено');
        }

        $role = Auth::role() ?? 'user';
        if (!Section::canView($section['id'], $role)) {
            http_response_code(403);
            exit('Немає доступу');
        }

        $posts = Section::posts($section['id']);

        $this->setMeta([
            'title' => $section['title'],
            'description' => $section['description']
        ]);

        ob_start();
        require __DIR__.'/../views/sections/view.php';
        $content = ob_get_clean();

        require __DIR__.'/../views/layout.php';
    }
}
