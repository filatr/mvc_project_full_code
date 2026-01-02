<?php

/**
 * Class Csrf
 *
 * Реалізує захист від CSRF (Cross-Site Request Forgery)
 *
 * Принцип роботи:
 * 1. Генерує унікальний токен
 * 2. Зберігає його в $_SESSION
 * 3. Додає токен у HTML-форми
 * 4. Перевіряє токен при POST-запитах
 *
 * Використовується у:
 * - формах логіну
 * - формах створення / редагування
 * - будь-яких POST-запитах
 */
class Csrf
{
    /**
     * Отримати CSRF-токен
     *
     * Якщо токен ще не створений — генерується
     * і зберігається в сесії
     *
     * @return string
     */
    public static function token(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            // Генеруємо криптостійкий випадковий токен
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    /**
     * Перевірити CSRF-токен
     *
     * @param string|null $token — токен з POST-запиту
     * @return bool
     */
    public static function check(?string $token): bool
    {
        // Перевіряємо, що токен існує і співпадає
        return isset($_SESSION['csrf_token'])
            && is_string($token)
            && hash_equals($_SESSION['csrf_token'], $token);
    }

    /**
     * Оновити CSRF-токен
     *
     * Можна викликати після успішної дії
     * (наприклад, після логіну або збереження форми)
     */
    public static function regenerate(): void
    {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
}
