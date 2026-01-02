<header class="admin-header">
    <h2>Адмінка</h2>
    <nav>
        <a href="index.php">Головна</a>
        <a href="items.php">Матеріали</a>
        <a href="sections.php">Розділи</a>

        <?php if ($_SESSION["role"] === "admin"): ?>
            <a href="users.php">Користувачі</a>
        <?php endif; ?>

        <a href="logout.php">Вийти</a>
    </nav>
</header>
