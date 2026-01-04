<h1>Адмінка — Записи</h1>

<p><a href="/adminpost/create">➕ Додати запис</a></p>

<table border="1" cellpadding="5">
    <tr>
        <th>ID</th>
        <th>Заголовок</th>
        <th>Дії</th>
    </tr>

    <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo $post['id']; ?></td>
            <td><?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="/adminpost/edit/<?php echo $post['id']; ?>">✏️</a>
                <a href="/adminpost/delete/<?php echo $post['id']; ?>"
                   onclick="return confirm('Видалити?')">🗑️</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
