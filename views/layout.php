<?php
require_once __DIR__.'/../core/Menu.php';
$menu = Menu::build();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($meta['title'] ?? 'Сайт', ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="description" content="<?= htmlspecialchars($meta['description'] ?? '', ENT_QUOTES, 'UTF-8') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<header>
    <nav>
        <?php Menu::render($menu); ?>
    </nav>
</header>

<main>
    <?= $content ?>
</main>

<footer>
    <p>&copy; <?= date('Y') ?></p>
</footer>

</body>
</html>
