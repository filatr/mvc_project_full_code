<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Мій сайт') ?></title>
<?php if (!empty($meta_description)): ?>
<meta name="description" content="<?= htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8') ?>">
<?php endif; ?>

    <link rel="stylesheet" href="/themes/default/assets/css/style.css">
</head>
<body>

<?php require ROOT . '/themes/default/header.php'; ?>

<main>
    <?= $content ?>
</main>

<?php require ROOT . '/themes/default/footer.php'; ?>

</body>
</html>
