<?php
/**
 * Головний шаблон сайту (Layout)
 *
 * Тут знаходиться:
 * - HTML-каркас сторінки
 * - <head> з meta-тегами
 * - header / footer
 * - підключення CSS / JS
 *
 * У змінній $content зберігається HTML конкретної сторінки,
 * який підставляється всередину layout.
 *
 * Файл використовується контролерами через:
 *   require __DIR__ . '/layout.php';
 */
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <?php
    /**
     * META-ТЕГИ (SEO)
     *
     * Клас Meta підключається в index.php або в Controller
     * Сюди передається масив $meta, наприклад:
     *
     * $meta = [
     *   'title' => 'Заголовок сторінки',
     *   'description' => 'Опис сторінки',
     *   'canonical' => 'https://site.ua/post/slug'
     * ];
     *
     * Якщо $meta не передано — помилки не буде
     */
    if (class_exists('Meta')) {
        Meta::render($meta ?? []);
    } else {
        // fallback, якщо Meta ще не підключений
        echo '<title>Сайт</title>';
    }
    ?>

    <!-- Адаптивність -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="/public/css/style.css">

</head>
<body>

<!-- ================= HEADER ================= -->

<header>
    <nav>
        <a href="/">Головна</a>

        <?php if (!empty($_SESSION['user'])): ?>
            <a href="/admin">Адмінка</a>
            <a href="/logout">Вийти</a>
        <?php else: ?>
            <a href="/login">Увійти</a>
        <?php endif; ?>
    </nav>
</header>

<hr>

<!-- ================= CONTENT ================= -->

<main>
    <?php
    /**
     * ОСНОВНИЙ ВМІСТ СТОРІНКИ
     *
     * $content — HTML, згенерований конкретним view-файлом
     * Наприклад:
     * - views/post/view.php
     * - views/admin/posts/index.php
     */
    echo $content;
    ?>
</main>

<hr>

<!-- ================= FOOTER ================= -->

<footer>
    <p>&copy; <?= date('Y') ?> Мій MVC-сайт</p>
</footer>

</body>
</html>
