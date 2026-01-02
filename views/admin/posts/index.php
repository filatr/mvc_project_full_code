<h1>Записи</h1>

<p><a href="/adminpost/create">+ Додати</a></p>

<ul>
<?php foreach ($posts as $post): ?>
    <li>
        <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
        |
        <a href="/adminpost/edit?id=<?= $post['id'] ?>">Редагувати</a>
        |
        <a href="/adminpost/delete?id=<?= $post['id'] ?>"
           onclick="return confirm('Видалити?')">Видалити</a>
    </li>
<?php endforeach; ?>
</ul>
