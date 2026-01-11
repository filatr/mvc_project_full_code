<?php require ROOT . '/views/partials/flash.php'; ?>

<h2>Адмінка — пости</h2>

<form method="post" action="/adminposts/delete" style="display:inline;">
    <input type="hidden" name="id" value="<?= $post['id'] ?>">
    <input type="hidden" name="csrf_token" value="<?= Csrf::token(); ?>">
    <button type="submit" onclick="return confirm('Видалити?')">🗑</button>
</form>

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
