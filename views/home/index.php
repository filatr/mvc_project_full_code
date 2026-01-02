<?php
/**
 * views/home/index.php
 * Головна сторінка сайту
 */

/** @var array $posts */
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Головна сторінка</title>
</head>
<body>

<h1>Головна сторінка</h1>

<?php if (empty($posts)): ?>
    <p>Поки що немає жодного запису.</p>
<?php else: ?>

    <?php foreach ($posts as $post): ?>
        <article>
            <h2>
                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
            </h2>

            <p>
                <?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')) ?>
            </p>

            <?php if (!empty($post['created_at'])): ?>
                <small>
                    Дата: <?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
                </small>
            <?php endif; ?>

            <hr>
        </article>
    <?php endforeach; ?>

<?php endif; ?>

</body>
</html>
