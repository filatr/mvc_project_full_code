<?php
/**
 * views/layouts/main.php
 * Основний layout сайту
 *
 * Змінна $content містить HTML конкретного шаблону
 * (наприклад: views/home/index.php)
 */
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <!-- Базовий meta viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Базовий title (пізніше зробимо динамічним) -->
    <title>Мій сайт</title>

    <!-- Тут пізніше можна підключити CSS теми -->
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->
</head>
<body>

<header>
    <h1>Мій сайт</h1>
    <nav>
        <a href="/">Головна</a>
        <a href="/login">Вхід</a>
        <a href="/admin">Адмінка</a>
    </nav>
    <hr>
</header>

<main>
    <?php
    /**
     * Вивід контенту конкретної сторінки
     * Контент формується у View через буферизацію
     */
    echo $content;
    ?>
</main>

<footer>
    <hr>
    <small>&copy; <?= date('Y') ?> Мій сайт</small>
</footer>

<!-- Тут пізніше можна підключати JS -->
<!-- <script src="/assets/js/app.js"></script> -->

</body>
</html>
