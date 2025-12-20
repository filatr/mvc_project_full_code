<article>
    <h1><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></h1>

    <div>
        <?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')) ?>
    </div>

    <?php if (!empty($post['image'])): ?>
        <figure>
            <img
                src="/uploads/<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>"
                alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>"
            >
        </figure>
    <?php endif; ?>
</article>
