<h2>Редагування поста</h2>

<form method="post">
    <p>
        <input type="text" name="title"
               value="<?= htmlspecialchars($post['title']) ?>" required>
    </p>

    <p>
        <textarea name="content" rows="10" cols="50" required><?= htmlspecialchars($post['content']) ?></textarea>
    </p>

    <button type="submit">Оновити</button>
</form>

<p><a href="/adminposts/index">← Назад</a></p>
