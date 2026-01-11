<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід в адмінку</title>
</head>
<body>

<h2>Вхід</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red;">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </p>
<?php endif; ?>

<form method="post" action="/login">
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <label>Пароль</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Увійти</button>
</form>

</body>
</html>
