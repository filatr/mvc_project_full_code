<article>
    <h2><?= htmlspecialchars($post['title']) ?></h2>

    <p>
        <small>
            Переглядів: <?= (int)$post['views'] ?>
        </small>
    </p>

    <div>
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>
</article>
