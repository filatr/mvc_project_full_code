<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Мій сайт' ?></title>

    <link rel="stylesheet" href="/themes/default/assets/css/style.css">
</head>
<body>

<?php require __DIR__ . '/header.php'; ?>

<main>
    <?= $content ?>
</main>

<?php require __DIR__ . '/footer.php'; ?>

<script src="/themes/default/assets/js/main.js"></script>
</body>
</html>
