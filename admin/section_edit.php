<?php
require_once "includes/auth.php";
require_once "../src/Database.php";

$pdo = Database::getInstance()->pdo();

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM sections WHERE id = :id")->execute([':id'=>$id]);
    header("Location: sections.php"); exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $parent_id = $_POST['parent_id'] ?: null;
    $slug = trim($_POST['slug'] ?? '');

    if ($name === '') $errors[] = "Назва необхідна";

    if ($slug === '') {
        $slug = mb_strtolower(preg_replace('/[^\p{L}\p{Nd}]+/u','-', $name));
        $slug = trim($slug, '-');
        if ($slug === '') $slug = 'section-'.time();
    }

    if (empty($errors)) {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE sections SET parent_id=:pid, name=:n, slug=:s, updated_at=NOW() WHERE id = :id");
            $stmt->execute([':pid'=>$parent_id, ':n'=>$name, ':s'=>$slug, ':id'=>$id]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO sections (parent_id, name, slug, created_at) VALUES (:pid, :n, :s, NOW())");
            $stmt->execute([':pid'=>$parent_id, ':n'=>$name, ':s'=>$slug]);
        }
        header("Location: sections.php"); exit;
    }
}

$section = null;
if ($id) {
    $sstmt = $pdo->prepare("SELECT * FROM sections WHERE id = :id");
    $sstmt->execute([':id'=>$id]);
    $section = $sstmt->fetch(PDO::FETCH_ASSOC);
}

// Список можливих батьків
$parents = $pdo->query("SELECT id, name FROM sections WHERE id != ".($id ?? 0))->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="uk">
<head><meta charset="utf-8"><title><?= $id ? "Редагувати розділ" : "Створити розділ" ?></title><link rel="stylesheet" href="css/admin.css"></head>
<body>
<?php include "includes/header.php"; ?>

<h1><?= $id ? "Редагувати розділ" : "Створити розділ" ?></h1>

<?php if ($errors): foreach($errors as $e): ?><p class="error"><?= htmlspecialchars($e) ?></p><?php endforeach; endif; ?>

<form method="post">
    <label>Назва:
        <input type="text" name="name" value="<?= htmlspecialchars($section['name'] ?? '') ?>" required>
    </label>
    <label>Slug:
        <input type="text" name="slug" value="<?= htmlspecialchars($section['slug'] ?? '') ?>">
    </label>
    <label>Батьківський розділ:
        <select name="parent_id">
            <option value="">(немає)</option>
            <?php foreach($parents as $p): ?>
                <option value="<?= $p['id'] ?>" <?= (isset($section['parent_id']) && $section['parent_id']==$p['id']) ? 'selected' : '' ?>><?= htmlspecialchars($p['name']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>

    <button type="submit"><?= $id ? "Зберегти" : "Створити" ?></button>
    <?php if ($id): ?><a href="section_edit.php?delete=<?= $id ?>" onclick="return confirm('Видалити розділ?')">Видалити</a><?php endif; ?>
</form>

<?php include "includes/footer.php"; ?>
</body>
</html>
