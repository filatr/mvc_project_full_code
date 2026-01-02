<?php
require_once "includes/auth.php";
require_once "../src/Database.php";
$db = new Database();

$items = $db->query("
    SELECT items.*, users.username
    FROM items
    LEFT JOIN users ON users.id = items.author_id
    ORDER BY items.created_at DESC
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Матеріали</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<?php include "includes/header.php"; ?>

<h1>Матеріали</h1>

<a class="btn" href="item_edit.php">+ Додати матеріал</a>

<table class="table">
    <tr>
        <th>ID</th>
        <th>Назва</th>
        <th>Автор</th>
        <th>Створено</th>
        <th></th>
    </tr>

    <?php foreach ($items as $it): ?>
        <tr>
            <td><?= $it["id"] ?></td>
            <td><?= htmlspecialchars($it["short_title"]) ?></td>
            <td><?= htmlspecialchars($it["username"]) ?></td>
            <td><?= $it["created_at"] ?></td>
            <td>
                <a href="item_edit.php?id=<?= $it["id"] ?>">Редагувати</a>
                |
                <a href="item_edit.php?delete=<?= $it["id"] ?>" onclick="return confirm('Видалити?')">Видалити</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "includes/footer.php"; ?>

</body>
</html>
