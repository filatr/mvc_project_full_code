<?php
/**
 * Список усіх постів (адмінка)
 *
 * Відповідає за відображення таблиці постів
 * з можливістю редагування та видалення.
 */

use Core\Auth;

/**
 * Захист сторінки
 * Якщо користувач не залогінений — редирект на /login
 */
Auth::check();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <title>Пости — Адмінка</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 1100px;
            margin: 40px auto;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
        }
        th {
            background: #eee;
        }
        a.button {
            display: inline-block;
            padding: 6px 10px;
            background: #2c7be5;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover {
            background: #1a5dc9;
        }
    </style>
</head>
<body>

<header>
    <h1>Пости</h1>

    <div>
        👤
        <?= htmlspecialchars($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8') ?>
        |
        <a href="/logout">Вийти</a>
    </div>
</header>

<nav>
    <a href="/admin">← Назад в адмінку</a> |
    <a href="/admin/posts/create" class="button">+ Додати пост</a>
</nav>

<hr>

<?php if (empty($posts)): ?>
    <p>Поки що постів немає.</p>
<?php else: ?>

<table>
    <tr>
        <th>ID</th>
        <th>Заголовок</th>
        <th>Slug (URL)</th>
        <th>Дата</th>
        <th>Дії</th>
    </tr>

    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= (int)$post['id'] ?></td>

            <td>
                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
            </td>

            <td>
                <?= htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8') ?>
            </td>

            <td>
                <?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
            </td>

            <td>
                <a href="/admin/posts/edit?id=<?= (int)$post['id'] ?>">
                    Редагувати
                </a>
                |
                <a href="/admin/posts/delete?id=<?= (int)$post['id'] ?>"
                   onclick="return confirm('Ви дійсно хочете видалити цей пост?')">
                    Видалити
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>

</body>
</html>
