<?php
require_once "includes/auth.php";
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Адмін-панель</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<h1>Дашборд</h1>

<div class="dashboard">
    <a class="card" href="items.php">Матеріали</a>
    <a class="card" href="sections.php">Розділи</a>

    <?php if ($_SESSION["role"] === "admin"): ?>
        <a class="card" href="users.php">Користувачі</a>
    <?php endif; ?>
</div>

<?php include "includes/footer.php"; ?>

</body>
</html>
