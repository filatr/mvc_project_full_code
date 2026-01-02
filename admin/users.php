<?php
require_once "includes/auth.php";
require_once "../src/Database.php";

if ($_SESSION['role'] !== 'admin') {
    echo "Доступ заборонено"; exit;
}

$pdo = Database::getInstance()->pdo();

// Видалення
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    if ($id == ($_SESSION['user_id'] ?? 0)) {
        // не дозволяємо видаляти себе
        header("Location: users.php"); exit;
    }
    $pdo->prepare("DELETE FROM users WHERE id = :id")->execute([':id'=>$id]);
    header("Location: users.php"); exit;
}

$users = $pdo->query("SELECT id,username,email,role,created_at,is_blocked FROM users ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="utf-8"><title>Користувачі</title><link rel="stylesheet" href="css/admin.css"></head>
<body>
<?php include "includes/header.php"; ?>

<h1>Користувачі</h1>
<a class="btn" href="user_edit.php">+ Додати користувача</a>

<table class="table">
    <tr><th>ID</th><th>login</th><th>email</th><th>role</th><th>blocked</th><th></th></tr>
    <?php foreach($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= $u['role'] ?></td>
            <td><?= $u['is_blocked'] ? 'yes' : 'no' ?></td>
            <td>
                <a href="user_edit.php?id=<?= $u['id'] ?>">Редагувати</a>
                <?php if ($u['id'] != ($_SESSION['user_id'] ?? 0)): ?> | <a href="users.php?delete=<?= $u['id'] ?>" onclick="return confirm('Видалити користувача?')">Видалити</a><?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "includes/footer.php"; ?>
</body>
</html>
