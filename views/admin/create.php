<?php
/**
 * Адмінка: створення нового поста
 * 
 * Очікує змінні:
 * - $title
 * - $error (необовʼязково)
 */
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            padding: 20px;
        }
        form {
            background: #fff;
            padding: 20px;
            max-width: 700px;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        textarea {
            min-height: 150px;
        }
        button {
            margin-top: 20px;
            padding: 10px 15px;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h1><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8') ?></h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
<?php endif; ?>

<form method="post">
    <label>Заголовок</label>
    <input type="text" name="title" required>

    <label>Текст поста</label>
    <textarea name="content" required></textarea>

    <button type="submit">💾 Зберегти</button>
</form>

<p><a href="/admin">← Назад</a></p>

</body>
</html>
