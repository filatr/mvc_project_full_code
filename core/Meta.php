<?php

class Meta
{
    public static function render(array $meta): void
    {
        echo '<title>' . htmlspecialchars($meta['title']) . '</title>';

        if (!empty($meta['description'])) {
            echo '<meta name="description" content="' .
                 htmlspecialchars($meta['description'], ENT_QUOTES, 'UTF-8') . '">';
        }

        if (!empty($meta['canonical'])) {
            echo '<link rel="canonical" href="' . htmlspecialchars($meta['canonical']) . '">';
        }
    }
}
