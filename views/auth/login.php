<h1>Вхід</h1>

<?php if (!empty($error)): ?>
    <p style="color:red;">
        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
    </p>
<?php endif; ?>

<form method="post">
    <label>
        Email:<br>
        <input type="email" name="email" required>
    </label><br><br>

    <label>
        Пароль:<br>
        <input type="password" name="password" required>
    </label><br><br>

    <button type="submit">Увійти</button>
</form>
