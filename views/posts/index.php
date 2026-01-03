<h1>Останні публікації</h1>

<?php if (empty($posts)): ?>
    <p>Поки що немає жодної публікації.</p>
<?php else: ?>
    <?php foreach ($posts as $post): ?>
        <article style="margin-bottom: 20px;">
            <h2>
                <a href="/post/view?id=<?= (int)$post['id'] ?>">
                    <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
                </a>
            </h2>

            <p>
                <?= nl2br(htmlspecialchars(mb_substr($post['content'], 0, 200), ENT_QUOTES, 'UTF-8')) ?>...
            </p>

            <small>
                Переглядів: <?= (int)$post['views'] ?>
            </small>
        </article>
    <?php endforeach; ?>
<?php endif; ?>
