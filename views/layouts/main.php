<?php
/**
 * -------------------------------------------------------
 * Основний layout сайту
 * -------------------------------------------------------
 * Тут формується HTML-обгортка сторінки
 * View підключається всередині <main>
 */
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <!-- SEO: заголовок сторінки -->
    <title>
        <?= isset($title)
            ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8')
            : 'Мій інформаційний сайт'
        ?>
    </title>

    <!-- SEO: description -->
    <meta name="description"
          content="<?= isset($metaDescription)
              ? htmlspecialchars($metaDescription, ENT_QUOTES, 'UTF-8')
              : 'Інформаційний сайт'
          ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Стилі -->
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header>
    <nav>
        <a href="/">Головна</a>

        <?php if (Auth::check()): ?>
            <a href="/logout">Вийти</a>

            <?php if (Auth::isAdmin()): ?>
                <a href="/admin">Адмінка</a>
            <?php endif; ?>

        <?php else: ?>
            <a href="/login">Вхід</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <?php
    /**
     * ---------------------------------------------------
     * Тут підключається конкретний View
     * ---------------------------------------------------
     */
    require $viewFile;
    ?>
</main>

<footer>
    <p>&copy; <?= date('Y') ?> Мій сайт</p>
</footer>

</body>
</html>
