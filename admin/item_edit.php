<?php
require_once "includes/auth.php";
require_once "../src/Database.php";

$pdo = Database::getInstance()->pdo();

// Видалення через ?delete=ID
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    // Тільки роль admin або editor може видаляти — можна додати додаткові перевірки
    $stmt = $pdo->prepare("DELETE FROM items WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header("Location: items.php");
    exit;
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Поля форми
    $short_title = trim($_POST['short_title'] ?? '');
    $short_description = trim($_POST['short_description'] ?? '');
    $content_title = trim($_POST['content_title'] ?? '');
    $content_description = trim($_POST['content_description'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');
    $url = trim($_POST['url'] ?? '');
    $visibility = $_POST['visibility'] ?? 'public';
    $slug = trim($_POST['slug'] ?? '');

    if ($short_title === '') $errors[] = "Короткий заголовок обов'язковий";
    if ($slug === '') {
        // згенеруємо slug якщо порожній
        $slug = mb_strtolower(preg_replace('/[^\p{L}\p{Nd}]+/u', '-', $short_title));
        $slug = trim($slug, '-');
        if ($slug === '') $slug = 'item-' . time();
    }

    if (empty($errors)) {
        if ($id) {
            // Оновлення
            $stmt = $pdo->prepare("UPDATE items SET short_title=:st, short_description=:sd, content_title=:ct, content_description=:cd, image_url=:img, url=:url, slug=:slug, visibility=:v, updated_at = NOW() WHERE id = :id");
            $stmt->execute([
                ':st'=>$short_title, ':sd'=>$short_description, ':ct'=>$content_title, ':cd'=>$content_description,
                ':img'=>$image_url, ':url'=>$url, ':slug'=>$slug, ':v'=>$visibility, ':id'=>$id
            ]);
            header("Location: items.php");
            exit;
        } else {
            // Створення — added_by беремо з сесії
            $added_by = $_SESSION['user_id'] ?? null;
            $stmt = $pdo->prepare("INSERT INTO items (url,slug,short_title,short_description,image_url,content_title,content_description,visibility,added_by,added_at,is_short) VALUES (:url,:slug,:st,:sd,:img,:ct,:cd,:v,:ab,NOW(),1)");
            $stmt->execute([
                ':url'=>$url, ':slug'=>$slug, ':st'=>$short_title, ':sd'=>$short_description, ':img'=>$image_url,
                ':ct'=>$content_title, ':cd'=>$content_description, ':v'=>$visibility, ':ab'=>$added_by
            ]);
            header("Location: items.php");
            exit;
        }
    }
}

// Якщо редагуємо — підтягаємо дані
$item = null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $item = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$item) {
        echo "Запис не знайдено"; exit;
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="utf-8">
    <title><?= $id ? "Редагувати запис" : "Створити запис" ?></title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<?php include "includes/header.php"; ?>

<h1><?= $id ? "Редагувати запис" : "Створити новий запис" ?></h1>

<?php if ($errors): ?>
    <div class="errors">
        <?php foreach ($errors as $e): ?><p class="error"><?= htmlspecialchars($e) ?></p><?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="post">
    <label>URL джерела:
        <input type="text" name="url" value="<?= htmlspecialchars($item['url'] ?? '') ?>" style="width:100%">
    </label>
    <label>Короткий заголовок:
        <input type="text" name="short_title" value="<?= htmlspecialchars($item['short_title'] ?? '') ?>" style="width:100%" required>
    </label>
    <label>Короткий опис:
        <textarea name="short_description" style="width:100%;height:80px"><?= htmlspecialchars($item['short_description'] ?? '') ?></textarea>
    </label>
    <label>Повний заголовок:
        <input type="text" name="content_title" value="<?= htmlspecialchars($item['content_title'] ?? '') ?>" style="width:100%">
    </label>
    <label>Повний текст:
        <textarea name="content_description" style="width:100%;height:200px"><?= htmlspecialchars($item['content_description'] ?? '') ?></textarea>
    </label>
    <label>Зображення (URL):
        <input type="text" name="image_url" value="<?= htmlspecialchars($item['image_url'] ?? '') ?>" style="width:100%">
    </label>
    <label>Slug (URL):
        <input type="text" name="slug" value="<?= htmlspecialchars($item['slug'] ?? '') ?>" style="width:100%">
    </label>
    <label>Видимість:
        <select name="visibility">
            <option value="public" <?= (($item['visibility'] ?? '') === 'public') ? 'selected' : '' ?>>Public</option>
            <option value="private" <?= (($item['visibility'] ?? '') === 'private') ? 'selected' : '' ?>>Private</option>
        </select>
    </label>

    <button type="submit"><?= $id ? "Зберегти" : "Створити" ?></button>
    <?php if ($id): ?>
        <a href="item_edit.php?delete=<?= $id ?>" onclick="return confirm('Видалити запис?')">Видалити</a>
    <?php endif; ?>
</form>

<?php include "includes/footer.php"; ?>
</body>
</html>
