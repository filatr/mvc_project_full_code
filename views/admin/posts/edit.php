<?php ob_start(); ?>

<h1>Редагування поста</h1>

<form method="post">
    <div class="mb-3">
        <label>Заголовок</label>
        <input type="text" name="title" class="form-control"
               value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>

    <div class="mb-3">
        <label>Контент</label>
        <textarea name="content" class="form-control" rows="6" required><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></textarea>
    </div>

    <button class="btn btn-success">Оновити</button>
</form>

<?php
$content = ob_get_clean();
require ROOT . '/views/layouts/admin.php';
