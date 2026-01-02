<?php
/**
 * Форма редагування поста
 */

use Core\Auth;
use Core\CSRF;

// Захист
Auth::check();

// CSRF
$csrfToken = CSRF::generate();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <title>Редагувати пост</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">

    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        textarea {
            min-height: 160px;
        }
        img {
            max-width: 300px;
            display: block;
            margin-top: 10px;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
            background: #2c7be5;
            border: none;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background: #1a5dc9;
        }
    </style>
</head>
<body>

<h1>Редагувати пост</h1>

<nav>
    <a href="/admin/posts">← Назад до списку</a>
</nav>

<hr>

<form action="/admin/posts/update"
      method="post"
      enctype="multipart/form-data">

    <!-- CSRF -->
    <input type="hidden"
           name="csrf_token"
           value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

    <!-- ID поста -->
    <input type="hidden"
           name="id"
           value="<?= (int)$post['id'] ?>">

    <!-- Заголовок -->
    <label>
        Заголовок
        <input type="text"
               name="title"
               required
               value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>">
    </label>

    <!-- Slug -->
    <label>
        Slug (URL)
        <input type="text"
               name="slug"
               value="<?= htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8') ?>">
    </label>

    <!-- Контент -->
    <label>
        Текст поста
        <textarea name="content"
                  required><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></textarea>
    </label>

    <!-- SEO -->
    <label>
        Meta title
        <input type="text"
               name="meta_title"
               value="<?= htmlspecialchars($post['meta_title'], ENT_QUOTES, 'UTF-8') ?>">
    </label>

    <label>
        Meta description
        <textarea name="meta_description"><?= htmlspecialchars($post['meta_description'], ENT_QUOTES, 'UTF-8') ?></textarea>
    </label>

    <!-- Поточне зображення -->
    <?php if (!empty($post['image'])): ?>
        <label>
            Поточне зображення
            <img src="<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>"
                 alt="Зображення поста">
        </label>
    <?php endif; ?>

    <!-- Нове зображення -->
    <label>
        Замінити зображення
        <input type="file"
               name="image"
               accept=".jpg,.jpeg,.png,.webp">
    </label>

    <button type="submit">
        💾 Зберегти зміни
    </button>

</form>

</body>
</html>
