<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <!-- TITLE -->
    <title>
        <?= htmlspecialchars($meta_title ?? 'Мій сайт', ENT_QUOTES, 'UTF-8') ?>
    </title>

    <!-- DESCRIPTION -->
    <meta name="description" content="<?= htmlspecialchars($meta_description ?? 'Опис сайту', ENT_QUOTES, 'UTF-8') ?>">

    <!-- ROBOTS -->
    <meta name="robots" content="<?= $meta_robots ?? 'index,follow' ?>">

    <!-- CANONICAL -->
    <?php if (!empty($canonical)): ?>
        <link rel="canonical" href="<?= htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8') ?>">
    <?php endif; ?>

</head>
<body>
