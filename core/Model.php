<?php
/**
 * core/Model.php
 *
 * Базовий клас для всіх моделей.
 * Забезпечує доступ до PDO через Database (Singleton).
 */

// Підключаємо клас Database
require_once ROOT . '/core/Database.php';

abstract class Model
{
    /**
     * @var PDO
     * PDO-зʼєднання з базою даних
     */
    protected $db;

    /**
     * Конструктор моделі
     *
     * Отримує PDO-зʼєднання через Database::getInstance()
     */
    public function __construct()
    {
        // ❗ ВАЖЛИВО:
        // НЕ new Database()
        // А ТІЛЬКИ через Singleton
        $this->db = Database::getInstance();
    }
}
