<?php ob_start(); ?>

<h1>Пости</h1>

<a href="/admin/posts/create" class="btn btn-primary mb-3">+ Додати пост</a>

<table class="table table-bordered">
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
                <a href="/admin/posts/edit/<?= $post['id'] ?>" class="btn btn-sm btn-warning">Редагувати</a>
                <a href="/admin/posts/delete/<?= $post['id'] ?>" class="btn btn-sm btn-danger"
                   onclick="return confirm('Видалити?')">Видалити</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
$content = ob_get_clean();
require ROOT . '/views/layouts/admin.php';
