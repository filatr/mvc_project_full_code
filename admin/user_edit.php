<?php
require_once "includes/auth.php";
require_once "../src/Database.php";

if ($_SESSION['role'] !== 'admin') { echo "Доступ заборонено"; exit; }

$pdo = Database::getInstance()->pdo();
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$errors = [];

if (isset($_GET['delete'])) {
    $did = (int)$_GET['delete'];
    if ($did == ($_SESSION['user_id'] ?? 0)) { header("Location: users.php"); exit; }
    $pdo->prepare("DELETE FROM users WHERE id = :id")->execute([':id'=>$did]);
    header("Location: users.php"); exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $role = $_POST['role'] ?? 'user';
    $is_blocked = isset($_POST['is_blocked']) ? 1 : 0;
    $password = trim($_POST['password'] ?? '');

    if ($username === '') $errors[] = "Логін обов'язковий";
    if ($email === '') $errors[] = "Email обов'язковий";

    // Перевірка унікальності username/email
    $params = [':username'=>$username, ':email'=>$email];
    if ($id) {
        $check = $pdo->prepare("SELECT id FROM users WHERE (username = :username OR email = :email) AND id != :id");
        $params[':id'] = $id;
        $check->execute($params);
    } else {
        $check = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $check->execute($params);
    }
    if ($check->fetch()) $errors[] = "Користувач з таким логіном або email вже існує";

    if (empty($errors)) {
        if ($id) {
            // Оновлення
            if ($password !== '') {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("UPDATE users SET username=:u, email=:e, role=:r, is_blocked=:b, password_hash=:ph, updated_at=NOW() WHERE id = :id");
                $stmt->execute([':u'=>$username, ':e'=>$email, ':r'=>$role, ':b'=>$is_blocked, ':ph'=>$hash, ':id'=>$id]);
            } else {
                $stmt = $pdo->prepare("UPDATE users SET username=:u, email=:e, role=:r, is_blocked=:b, updated_at=NOW() WHERE id = :id");
                $stmt->execute([':u'=>$username, ':e'=>$email, ':r'=>$role, ':b'=>$is_blocked, ':id'=>$id]);
            }
            header("Location: users.php"); exit;
        } else {
            // Створення
            if ($password === '') $errors[] = "Пароль обов'язковий для нового користувача";
            else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (username,email,password_hash,role,created_at) VALUES (:u,:e,:ph,:r,NOW())");
                $stmt->execute([':u'=>$username,':e'=>$email,':ph'=>$hash,':r'=>$role]);
                header("Location: users.php"); exit;
            }
        }
    }
}

$user = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT id,username,email,role,is_blocked FROM users WHERE id = :id");
    $stmt->execute([':id'=>$id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="utf-8"><title><?= $id ? "Редагувати користувача" : "Додати користувача" ?></title><link rel="stylesheet" href="css/admin.css"></head>
<body>
<?php include "includes/header.php"; ?>

<h1><?= $id ? "Редагувати користувача" : "Додати користувача" ?></h1>

<?php if ($errors): foreach($errors as $e): ?><p class="error"><?= htmlspecialchars($e) ?></p><?php endforeach; endif; ?>

<form method="post">
    <label>Логін: <input type="text" name="username" value="<?= htmlspecialchars($user['username'] ?? '') ?>" required></label>
    <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required></label>
    <label>Роль:
        <select name="role">
            <option value="user" <?= (isset($user['role']) && $user['role']=='user') ? 'selected' : '' ?>>user</option>
            <option value="editor" <?= (isset($user['role']) && $user['role']=='editor') ? 'selected' : '' ?>>editor</option>
            <option value="admin" <?= (isset($user['role']) && $user['role']=='admin') ? 'selected' : '' ?>>admin</option>
        </select>
    </label>
    <label>Пароль: <input type="password" name="password" <?= $id ? '' : 'required' ?>></label>
    <label>Заблоковано: <input type="checkbox" name="is_blocked" <?= (isset($user['is_blocked']) && $user['is_blocked']) ? 'checked' : '' ?>></label>

    <button type="submit"><?= $id ? "Зберегти" : "Створити" ?></button>

    <?php if ($id): ?>
        <a href="user_edit.php?delete=<?= $id ?>" onclick="return confirm('Видалити користувача?')">Видалити</a>
    <?php endif; ?>
</form>

<?php include "includes/footer.php"; ?>
</body>
</html>
