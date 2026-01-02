<?php
/**
 * View: форма редагування запису
 *
 * ЗАВДАННЯ:
 *  - показати форму з уже існуючими даними
 *  - відобразити помилки
 *  - відправити POST у PostController::edit($id)
 *
 * Дані з контролера:
 *  $post  — масив з даними запису
 *  $error — повідомлення про помилку (якщо є)
 */

use Core\Csrf;
?>

<h1>Редагувати запис</h1>

<?php if (!empty($error)): ?>
    <p style="color:red;">
        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </p>
<?php endif; ?>

<?php if (empty($post)): ?>
    <p>Запис не знайдено.</p>
    <p><a href="/post">← Повернутися</a></p>
    <?php return; ?>
<?php endif; ?>

<form method="post" action="/post/edit/<?php echo (int)$post['id']; ?>">

    <!-- CSRF-токен -->
    <input type="hidden"
           name="csrf_token"
           value="<?php echo Csrf::token(); ?>">

    <p>
        <label>
            Заголовок:<br>
            <input type="text"
                   name="title"
                   value="<?php
                       echo htmlspecialchars(
                           $post['title'],
                           ENT_QUOTES,
                           'UTF-8'
                       );
                   ?>"
                   required>
        </label>
    </p>

    <p>
        <label>
            Текст запису:<br>
            <textarea name="content"
                      rows="10"
                      cols="60"
                      required><?php
                echo htmlspecialchars(
                    $post['content'],
                    ENT_QUOTES,
                    'UTF-8'
                );
            ?></textarea>
        </label>
    </p>

    <p>
        <button type="submit">💾 Зберегти зміни</button>
        <a href="/post/show/<?php echo (int)$post['id']; ?>">Скасувати</a>
    </p>

</form>
