<h1>Головна сторінка</h1>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <article class="mb-3">
            <h2><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h2>
            <p><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></p>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <p>Поки що немає записів</p>
<?php endif; ?>
