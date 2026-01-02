<?php
/**
 * Dashboard адмінки
 *
 * Доступні змінні:
 * @var array $meta SEO meta-теги
 */

// Підключаємо головний layout
require __DIR__ . '/../layouts/main.php';
?>

<h1>Адмін-панель</h1>

<p>
    Вітаємо,
    <strong><?= htmlspecialchars($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8') ?></strong>
</p>

<section>
    <h2>Керування сайтом</h2>

    <ul>
        <li><a href="/admin/posts">Записи</a></li>
        <li><a href="/admin/posts/create">Додати запис</a></li>
        <li><a href="/admin/categories">Розділи</a></li>
        <li><a href="/admin/users">Користувачі</a></li>
    </ul>
</section>

<section>
    <h2>Службова інформація</h2>

    <ul>
        <li>Дата входу: <?= htmlspecialchars($_SESSION['user']['last_login'] ?? '—', ENT_QUOTES, 'UTF-8') ?></li>
        <li>Роль: <?= htmlspecialchars($_SESSION['user']['role'] ?? 'user', ENT_QUOTES, 'UTF-8') ?></li>
    </ul>
</section>

</main>
</body>
</html>
