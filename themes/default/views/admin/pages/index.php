<h2>Сторінки</h2>
<a href="/admin/pages/create">+ Додати</a>

<ul>
<?php foreach ($pages as $page): ?>
    <li>
        <?= htmlspecialchars($page['title']) ?>
        <a href="/admin/pages/edit/<?= $page['id'] ?>">Редагувати</a>
        <a href="/admin/pages/delete/<?= $page['id'] ?>"
           onclick="return confirm('Видалити?')">X</a>
    </li>
<?php endforeach; ?>
</ul>
