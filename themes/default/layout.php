<?php
// Захист від прямого доступу
if (!defined('ROOT')) {
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Мій сайт', ENT_QUOTES, 'UTF-8') ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS шаблону -->
    <link rel="stylesheet" href="/themes/default/assets/css/style.css">
</head>
<body>

<?php require THEME_PATH . '/header.php'; ?>

<main class="container mt-4">
    <?php require $viewFile; ?>
</main>

<?php require THEME_PATH . '/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/themes/default/assets/js/app.js"></script>
</body>
</html>
