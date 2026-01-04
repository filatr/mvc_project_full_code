<h1>Усі пости</h1>

<?php foreach ($posts as $post): ?>
    <article>
        <h2>
            <a href="/post/view/<?php echo (int)$post['id']; ?>">
                <?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </h2>

        <p>
            <?php echo nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')); ?>
        </p>

        <small>
            <?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8'); ?>
        </small>
    </article>
    <hr>
<?php endforeach; ?>
