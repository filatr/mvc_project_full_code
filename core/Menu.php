<?php
/**
 * Побудова меню з розділів (рекурсивно)
 */
class Menu {

    /**
     * Отримує всі розділи та будує дерево
     */
    public static function build(): array {
        $sections = Database::connect()
            ->query("SELECT * FROM sections WHERE is_public = 1 ORDER BY parent_id, title")
            ->fetchAll(PDO::FETCH_ASSOC);

        return self::tree($sections);
    }

    /**
     * Рекурсивно будує дерево розділів
     */
    private static function tree(array $sections, ?int $parent = null): array {
        $branch = [];

        foreach ($sections as $section) {
            if ((int)$section['parent_id'] === (int)$parent) {
                $children = self::tree($sections, (int)$section['id']);
                if ($children) {
                    $section['children'] = $children;
                }
                $branch[] = $section;
            }
        }

        return $branch;
    }

    /**
     * Вивід HTML меню
     */
    public static function render(array $items): void {
        echo '<ul>';

        foreach ($items as $item) {
            echo '<li>';
            echo '<a href="/section/' .
                 htmlspecialchars($item['slug'], ENT_QUOTES, 'UTF-8') .
                 '">' .
                 htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8') .
                 '</a>';

            if (!empty($item['children'])) {
                self::render($item['children']);
            }

            echo '</li>';
        }

        echo '</ul>';
    }
}
