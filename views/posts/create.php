<?php
/**
 * Форма створення нового поста (адмінка)
 *
 * Тут:
 * - вводиться заголовок
 * - текст поста
 * - завантаження зображення
 * - CSRF-захист
 */

// Підключаємо CSRF-клас (через автозавантаження або напряму)
$csrfToken = Csrf::token();
?>

<h1>Створити новий пост</h1>

<form method="post" action="/admin/posts/store" enctype="multipart/form-data">

    <!-- CSRF захист -->
    <input type="hidden" name="csrf_token"
           value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

    <!-- Заголовок -->
    <div>
        <label for="title">Заголовок</label><br>
        <input type="text"
               id="title"
               name="title"
               required
               value="<?= isset($_POST['title']) 
                    ? htmlspecialchars($_POST['title'], ENT_QUOTES, 'UTF-8') 
                    : '' ?>">
    </div>

    <br>

    <!-- Контент -->
    <div>
        <label for="content">Текст поста</label><br>
        <textarea id="content"
                  name="content"
                  rows="8"
                  required><?= isset($_POST['content']) 
                        ? htmlspecialchars($_POST['content'], ENT_QUOTES, 'UTF-8') 
                        : '' ?></textarea>
    </div>

    <br>

    <!-- Зображення -->
    <div>
        <label for="image">Зображення (jpg, png, webp)</label><br>
        <input type="file"
               id="image"
               name="image"
               accept=".jpg,.jpeg,.png,.webp">
    </div>

    <br>

    <!-- Кнопка -->
    <button type="submit">Зберегти</button>

</form>
