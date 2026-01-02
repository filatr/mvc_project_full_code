<?php
/**
 * View одного запису
 *
 * Доступні змінні:
 * @var array $post  Дані запису
 * @var array $meta  SEO meta-теги
 */

// Підключаємо головний layout
require __DIR__ . '/../layouts/main.php';
?>

<article>

    <h1>
        <?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>
    </h1>

    <?php if (!empty($post['image'])): ?>
        <figure>
            <img
                src="/uploads/<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>"
                alt="<?= htmlspecialchars($post['title'], ENT_QUOTES, 'UTF-8') ?>"
                loading="lazy"
            >
        </figure>
    <?php endif; ?>

    <div class="content">
        <?php
        /**
         * Контент дозволяємо з HTML
         * ВАЖЛИВО:
         *  - дані мають очищатись при збереженні (admin)
         *  - тут НЕ використовуємо htmlspecialchars
         */
        echo $post['content'];
        ?>
    </div>

    <footer>
        <small>
            Опубліковано:
            <?= htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
        </small>
    </footer>

</article>

</body>
</html>
