<?php
/**
 * views/auth/login.php
 *
 * Сторінка входу користувача
 *
 * ВХІДНІ ДАНІ:
 *  - $error (string|null) — повідомлення про помилку
 *
 * ❗ Усі дані екрануються
 * ❗ Форма захищена CSRF-токеном
 */
?>

<h2>Вхід до системи</h2>

<?php if (!empty($error)): ?>
    <p style="color: red;">
        <?php
        echo htmlspecialchars(
            $error,
            ENT_QUOTES,
            'UTF-8'
        );
        ?>
    </p>
<?php endif; ?>

<form method="post" action="/login">

    <!-- CSRF захист -->
    <input type="hidden" name="csrf_token"
           value="<?php echo htmlspecialchars(
               $_SESSION['csrf_token'],
               ENT_QUOTES,
               'UTF-8'
           ); ?>">

    <div>
        <label>
            Логін:
            <input type="text"
                   name="username"
                   required>
        </label>
    </div>

    <div>
        <label>
            Пароль:
            <input type="password"
                   name="password"
                   required>
        </label>
    </div>

    <button type="submit">
        Увійти
    </button>

</form>
