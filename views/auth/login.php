<h2>Вхід</h2>

<?php if (!empty($error)): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
    </p>
<?php endif; ?>

<form method="post">
    <div>
        <label>Логін</label><br>
        <input type="text" name="username" required>
    </div>

    <div>
        <label>Пароль</label><br>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Увійти</button>
</form>
