<?php
$messages = Flash::get();
?>

<?php foreach ($messages as $type => $items): ?>
    <?php foreach ($items as $message): ?>
        <div style="padding:8px;margin:5px 0;border:1px solid #ccc;">
            <strong><?= strtoupper($type) ?>:</strong>
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>
