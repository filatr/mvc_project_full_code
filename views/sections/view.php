<h1><?= htmlspecialchars($section['title'], ENT_QUOTES, 'UTF-8') ?></h1>

<?php if (!empty($section['description'])): ?>
    <p>
        <?= nl2br(htmlspecialchars($section['description'], ENT_QUOTES, 'UTF-8')) ?>
    </p>
<?php endif; ?>

<?php foreach ($posts as $post): ?>
    <article>
        <h2>
            <a href="/post/<?= htmlspecialchars($post['slug'], ENT_QUOTES, 'UTF-8') ?>">
                <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
            </a>
        </h2>
    </article>
<?php endforeach; ?>
