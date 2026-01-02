<?php
require_once "includes/auth.php";
require_once "../src/Database.php";
$pdo = Database::getInstance()->pdo();

$stmt = $pdo->query("SELECT * FROM sections ORDER BY parent_id, name");
$sections = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="utf-8"><title>Розділи</title><link rel="stylesheet" href="css/admin.css"></head>
<body>
<?php include "includes/header.php"; ?>

<h1>Розділи</h1>
<a class="btn" href="section_edit.php">+ Додати розділ</a>

<table class="table">
    <tr><th>ID</th><th>Назва</th><th>Slug</th><th>Parent</th><th></th></tr>
    <?php foreach($sections as $s): ?>
        <tr>
            <td><?= $s['id'] ?></td>
            <td><?= htmlspecialchars($s['name']) ?></td>
            <td><?= htmlspecialchars($s['slug']) ?></td>
            <td><?= $s['parent_id'] ? $s['parent_id'] : '-' ?></td>
            <td>
                <a href="section_edit.php?id=<?= $s['id'] ?>">Редагувати</a> |
                <a href="section_edit.php?delete=<?= $s['id'] ?>" onclick="return confirm('Видалити розділ?')">Видалити</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "includes/footer.php"; ?>
</body>
</html>
