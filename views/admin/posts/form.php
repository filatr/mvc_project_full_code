<h1><?= $post ? 'Редагування' : 'Створення' ?> запису</h1>

<form method="post" enctype="multipart/form-data">
    <input type="hidden" name="csrf" value="<?= $csrf ?>">

    <label>Заголовок</label><br>
    <input type="text" name="title"
           value="<?= htmlspecialchars($post['title'] ?? '') ?>"
           required><br><br>

    <label>Контент</label><br>
    <textarea name="content" rows="8" required><?= htmlspecialchars($post['content'] ?? '') ?></textarea><br><br>

    <label>Зображення</label><br>
    <input type="file" name="image" accept="image/*"><br>

    <?php if (!empty($post['image'])): ?>
        <p>
            <img src="<?= $post['image'] ?>" style="max-width:200px">
        </p>
    <?php endif; ?>

    <button>Зберегти</button>
</form>
