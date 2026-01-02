<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">

    <!-- SEO: базові мета-теги -->
    <title>Головна сторінка</title>
    <meta name="description" content="Інформаційний сайт з публікаціями">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Простий базовий стиль -->
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            line-height: 1.6;
        }
        article {
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }
        h2 a {
            text-decoration: none;
            color: #333;
        }
        h2 a:hover {
            text-decoration: underline;
        }
        .date {
            color: #777;
            font-size: 0.9em;
        }
    </style>
</head>
<body>

<h1>Останні публікації</h1>

<?php if (empty($posts)): ?>
    <p>Записів поки що немає.</p>
<?php endif; ?>

<?php foreach ($posts as $post): ?>
    <article>

        <h2>
            <a href="/post/<?= htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8') ?>">
    <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
</a>

        </h2>

        <div class="date">
            <?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
        </div>

        <p>
            <?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')) ?>
        </p>

    </article>
<?php endforeach; ?>

</body>
</html>
