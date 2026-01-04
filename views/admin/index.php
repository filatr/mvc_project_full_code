<h2>Пости</h2>

<a href="/adminpost/create">➕ Додати пост</a>

<ul>
<?php foreach ($posts as $post): ?>
    <li>
        <strong><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></strong>
        (<?= $post['status'] ?>)

        <a href="/adminpost/edit/<?= $post['id'] ?>">✏️</a>
        <a href="/adminpost/delete/<?= $post['id'] ?>"
           onclick="return confirm('Видалити?')">🗑</a>
    </li>
<?php endforeach; ?>
</ul>
