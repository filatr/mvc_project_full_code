<?php
/**
 * Головний layout сайту
 * Використовується для всіх сторінок теми "default"
 *
 * Змінна $content — HTML з конкретного view
 * Інші змінні передаються через $this->view->set()
 */
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <!-- SEO -->
    <title><?= htmlspecialchars($title ?? 'Мій сайт', ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta_description ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <meta name="keywords" content="<?= htmlspecialchars($meta_keywords ?? '', ENT_QUOTES, 'UTF-8') ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS теми -->
    <link rel="stylesheet" href="/themes/default/assets/css/style.css">

    <!-- TinyMCE (підключається лише там, де є textarea.wysiwyg) -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"
            referrerpolicy="origin"></script>
</head>
<body>

<header>
    <h1>
        <a href="/" style="text-decoration:none;color:inherit;">
            Мій CMS-сайт
        </a>
    </h1>

    <nav>
        <a href="/">Головна</a>

        <?php if (!empty($_SESSION['user'])): ?>
            <a href="/admin">Адмінка</a>
            <a href="/logout">Вийти</a>
        <?php else: ?>
            <a href="/login">Вхід</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <?php
    /**
     * Основний контент сторінки
     * Сюди підставляється HTML з конкретного view-файлу
     */
    ?>
    <?= $content ?>
</main>

<footer>
    <small>
        © <?= date('Y') ?> |
        Powered by custom MVC CMS
    </small>
</footer>

<!-- Ініціалізація WYSIWYG (безпечна) -->
<script>
if (typeof tinymce !== 'undefined') {
    tinymce.init({
        selector: '.wysiwyg',
        height: 400,
        menubar: true,
        plugins: 'link image code lists',
        toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | image | code',
        relative_urls: false,
        convert_urls: false
    });
}
</script>

</body>
</html>
