<h2>Медіафайли</h2>

<a href="/admin/media/upload">+ Додати файл</a>

<ul>
<?php foreach ($media as $item): ?>
    <li>
        <?= htmlspecialchars($item['original_name']) ?>
        <br>
        <img src="/uploads/images/<?= htmlspecialchars($item['filename']) ?>"
             style="max-width:150px">
    </li>
<?php endforeach; ?>
</ul>
