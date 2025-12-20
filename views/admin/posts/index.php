<h1>Адмінка: записи</h1>

<p>
    <a href="/admin/create">➕ Додати запис</a>
</p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Заголовок</th>
        <th>Дії</th>
    </tr>

    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= (int)$post['id'] ?></td>
            <td><?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?></td>
            <td>
                <a href="/admin/edit?id=<?= (int)$post['id'] ?>">Редагувати</a>
                |
                <a href="/admin/delete?id=<?= (int)$post['id'] ?>"
                   onclick="return confirm('Видалити?')">
                   Видалити
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
