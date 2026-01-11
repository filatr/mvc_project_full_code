<h2>Адмінка — пости</h2>

<p><a href="/adminposts/create">+ Додати пост</a> | <a href="/logout">Вийти</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Заголовок</th>
        <th>Дата</th>
        <th>Дії</th>
    </tr>

    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?= $post['id'] ?></td>
            <td><?= htmlspecialchars($post['title']) ?></td>
            <td><?= $post['created_at'] ?></td>
            <td>
                <a href="/adminposts/edit?id=<?= $post['id'] ?>">✏️</a>
                <a href="/adminposts/delete?id=<?= $post['id'] ?>"
                   onclick="return confirm('Видалити?')">🗑</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
