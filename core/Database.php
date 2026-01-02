<?php
/**
 * core/Database.php
 *
 * Клас Database відповідає за:
 * - створення PDO-зʼєднання з MySQL
 * - налаштування помилок
 * - використання одного зʼєднання (Singleton)
 */

class Database
{
    /**
     * @var PDO|null
     * Статична змінна для збереження одного PDO-обʼєкта
     */
    private static ?PDO $instance = null;

    /**
     * Забороняємо створення обʼєкта напряму
     */
    private function __construct() {}

    /**
     * Забороняємо клонування
     */
    private function __clone() {}

    /**
     * Повертає PDO-зʼєднання (Singleton)
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {

            // === НАЛАШТУВАННЯ БД ===
            $host = 'db24.freehost.com.ua';
            $db   = 'buyorifla_pdv0';
            $user = 'buyorifla_pdv0';
            $pass = 'rPris5Ilh';
            $charset = 'utf8mb4';

            // DSN — опис підключення
            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";

            // Опції PDO
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // показувати помилки
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // асоціативні масиви
                PDO::ATTR_EMULATE_PREPARES   => false,                  // реальні prepare
            ];

            try {
                // Створюємо PDO
                self::$instance = new PDO($dsn, $user, $pass, $options);
            } catch (PDOException $e) {
                // У продакшені тут лог, не echo
                die('Помилка підключення до БД: ' . $e->getMessage());
            }
        }

        return self::$instance;
    }
}
