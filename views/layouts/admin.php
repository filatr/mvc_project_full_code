<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Адмінка', ENT_QUOTES, 'UTF-8') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<header>
    <strong>Адмінка</strong> |
    <a href="/">Сайт</a> |
    <a href="/login/logout">Вийти</a>
</header>

<hr>

<main>
    <?php require $viewFile; ?>
</main>

<hr>

<footer>
    <small>Admin Panel</small>
</footer>

</body>
</html>
