<h1>Останні записи</h1>

<?php foreach ($posts as $post): ?>
    <article>
        <h2>
            <a href="/post/<?= htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
            </a>
        </h2>

        <p>
            <?= nl2br(htmlspecialchars($post['excerpt'], ENT_QUOTES, 'UTF-8')) ?>
        </p>
    </article>
<?php endforeach; ?>
