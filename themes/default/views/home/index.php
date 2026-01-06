<h2>Останні записи</h2>

<?php foreach ($posts as $post): ?>
    <article>
        <h3>
            <a href="/post/<?= $post['id'] ?>">
                <?= htmlspecialchars($post['title']) ?>
            </a>
        </h3>
        <p><?= mb_substr(strip_tags($post['content']), 0, 150) ?>...</p>
    </article>
<?php endforeach; ?>
