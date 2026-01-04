<h2>Редагування</h2>

<form method="post">
    <input type="text" name="title"
        value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>" required><br><br>

    <textarea name="content" rows="8" required><?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?></textarea><br><br>

    <select name="status">
        <option value="draft" <?= $post['status'] === 'draft' ? 'selected' : '' ?>>Чернетка</option>
        <option value="published" <?= $post['status'] === 'published' ? 'selected' : '' ?>>Опубліковано</option>
    </select><br><br>

    <button>Оновити</button>
</form>
