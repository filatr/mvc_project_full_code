<h1>Редагування запису</h1>

<form method="post">
    <label>Заголовок</label><br>
    <input type="text" name="title"
           value="<?php echo htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8'); ?>"><br><br>

    <label>Текст</label><br>
    <textarea name="content" rows="10" cols="50"><?php
        echo htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8');
    ?></textarea><br><br>

    <button type="submit">Оновити</button>
</form>
