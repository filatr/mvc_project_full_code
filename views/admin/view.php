<?php
/**
 * Перегляд поста
 * Змінна $post гарантовано існує
 */
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></title>

    <meta name="description"
          content="<?= htmlspecialchars(mb_substr(strip_tags($post['content']), 0, 160), ENT_QUOTES, 'UTF-8') ?>">
</head>
<body>

<h1><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h1>

<p>
    <small>
        Переглядів:
        <?= (int)$post['views'] ?>
    </small>
</p>

<div>
    <?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')) ?>
</div>

<p><a href="/">← На головну</a></p>

</body>
</html>
