<?php
/**
 * Клас для безпечного завантаження файлів
 */
class Upload {

    /**
     * Завантажити зображення
     */
    public static function image(array $file): ?string {

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // Дозволені MIME типи
        $allowed = [
            'image/jpeg' => 'jpg',
            'image/png'  => 'png',
            'image/webp' => 'webp'
        ];

        $mime = mime_content_type($file['tmp_name']);

        if (!isset($allowed[$mime])) {
            exit('Недозволений тип файлу');
        }

        // Генеруємо безпечне імʼя
        $name = uniqid('img_', true) . '.' . $allowed[$mime];
        $dir = __DIR__ . '/../public/uploads/';

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        move_uploaded_file($file['tmp_name'], $dir . $name);

        return '/public/uploads/' . $name;
    }
}
