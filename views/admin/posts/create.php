<?php ob_start(); ?>

<h1>Новий пост</h1>

<form method="post">
    <div class="mb-3">
        <label>Заголовок</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Контент</label>
        <textarea name="content" class="form-control" rows="6" required></textarea>
    </div>

    <button class="btn btn-success">Зберегти</button>
</form>

<?php
$content = ob_get_clean();
require ROOT . '/views/layouts/admin.php';
