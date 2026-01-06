<h2>Редагування поста</h2>

<form method="post">
    <label>Заголовок</label><br>
    <input type="text" name="title"
           value="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>"
           style="width:100%"><br><br>

    <label>Контент</label><br>
    <textarea name="content"
              class="wysiwyg"
              style="width:100%; height:300px;">
<?= htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8') ?>
    </textarea><br><br>

    <button>Зберегти</button>
</form>
