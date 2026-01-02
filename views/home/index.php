<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Головна</title>
    <style>
        body {
            font-family: Arial;
            padding: 40px;
        }
        a {
            display: inline-block;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<h1>Головна сторінка</h1>

<p>Ласкаво просимо на сайт.</p>

<?php if (!empty($_SESSION['user'])): ?>

    <p>
        Ви увійшли як:
        <b><?= htmlspecialchars($_SESSION['user']['login'], ENT_QUOTES, 'UTF-8') ?></b>
    </p>

    <a href="/admin">Адмінка</a>
    <a href="/logout">Вийти</a>

<?php else: ?>

    <a href="/login">Увійти</a>

<?php endif; ?>

</body>
</html>
