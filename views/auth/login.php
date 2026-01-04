<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід</title>
</head>
<body>

<h1>Вхід в адмінку</h1>

<?php if (!empty($error)): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="post">
    <div>
        <label>Email</label><br>
        <input type="email" name="email" required>
    </div>

    <div>
        <label>Пароль</label><br>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Увійти</button>
</form>

</body>
</html>
