<h1><?php echo htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?></h1>

<?php foreach ($posts as $post): ?>
    <article>
        <h2>
            <a href="/post/<?php echo $post['id']; ?>">
                <?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </h2>
    </article>
<?php endforeach; ?>
