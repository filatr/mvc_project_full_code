<?php
/**
 * Редагування поста
 * Змінна $post гарантовано існує
 */
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>
</head>
<body>

<h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>

<?php if (!empty($error)): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="post">
    <label>Заголовок</label><br>
    <input type="text" name="title"
           value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>"
           required><br><br>

    <label>Текст</label><br>
    <textarea name="content" required><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

    <button type="submit">💾 Оновити</button>
</form>

<p><a href="/admin">← Назад</a></p>

</body>
</html>
