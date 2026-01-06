<h2>Шаблони</h2>

<ul>
<?php foreach ($themes as $theme): ?>
    <li>
        <strong><?= htmlspecialchars($theme) ?></strong>

        <?php if ($theme === $currentTheme): ?>
            — <em>активний</em>
        <?php else: ?>
            <a href="/admin/themes/activate/<?= $theme ?>">
                Активувати
            </a>
        <?php endif; ?>
    </li>
<?php endforeach; ?>
</ul>
