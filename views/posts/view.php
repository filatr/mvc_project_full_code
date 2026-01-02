<?php
/**
 * -------------------------------------------------------
 * View: Перегляд одного запису
 * -------------------------------------------------------
 * Змінні, доступні у файлі:
 * @var array $post
 */
?>

<article class="post">

    <!-- Заголовок запису -->
    <h1>
        <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
    </h1>

    <!-- Дата створення -->
    <div class="post-meta">
        Опубліковано:
        <?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
    </div>

    <!-- Зображення запису -->
    <?php if (!empty($post['image'])): ?>
        <div class="post-image">
            <img
                src="/uploads/<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>"
                alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>"
            >
        </div>
    <?php endif; ?>

    <!-- Короткий опис -->
    <?php if (!empty($post['description'])): ?>
        <p class="post-description">
            <?= nl2br(htmlspecialchars($post['description'], ENT_QUOTES, 'UTF-8')) ?>
        </p>
    <?php endif; ?>

    <!-- Основний контент -->
    <div class="post-content">
        <?= nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8')) ?>
    </div>

</article>
