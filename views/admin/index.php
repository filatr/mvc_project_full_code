<?php
/**
 * -------------------------------------------------------
 * Адмінка — список постів
 * -------------------------------------------------------
 *
 * Очікує змінні:
 * @var string $title
 * @var array  $posts
 */
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
        .post {
            background: #fff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
        }
        .actions a {
            margin-right: 10px;
            text-decoration: none;
        }
        .actions a.delete {
            color: red;
        }
    </style>
</head>
<body>

<h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>

<p>
    <a href="/admin/create">➕ Створити новий пост</a>
</p>

<?php if (empty($posts)): ?>
    <p>Постів поки немає.</p>
<?php else: ?>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <strong>
                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
            </strong>
            <br>
            <small>
                Створено:
                <?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
            </small>

            <div class="actions">
                <a href="/admin/edit/<?= (int)$post['id'] ?>">
                    ✏️ Редагувати
                </a>

                <a href="/admin/delete/<?= (int)$post['id'] ?>"
                   class="delete"
                   onclick="return confirm('Ви дійсно хочете видалити цей пост?');">
                    ❌ Видалити
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

</body>
</html>
