<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <title>
        <?php echo htmlspecialchars($meta_title ?? 'Мій сайт', ENT_QUOTES, 'UTF-8'); ?>
    </title>

    <meta name="description" content="<?php
        echo htmlspecialchars(
            $meta_description ?? 'Опис сайту',
            ENT_QUOTES,
            'UTF-8'
        );
    ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>

<header>
    <a href="/">Головна</a>
</header>

<main>
    <?php echo $content; ?>
</main>

<footer>
    <small>&copy; <?php echo date('Y'); ?></small>
</footer>

</body>
</html>
