<?php
/**
 * Базова модель
 * Усі моделі наслідують цей клас
 */

require_once __DIR__ . '/Database.php';

abstract class Model
{
    /**
     * PDO-підключення до БД
     */
    protected PDO $db;

    /**
     * Назва таблиці (визначається в дочірніх класах)
     */
    protected string $table;

    public function __construct()
    {
        // Отримуємо PDO з Database
        $this->db = Database::getInstance()->getConnection();
    }

    /**
     * Отримати всі записи з таблиці
     */
    public function all(): array
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table}");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Знайти запис по ID
     */
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1"
        );
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result ?: null;
    }

    /**
     * Видалити запис
     */
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        return $stmt->execute(['id' => $id]);
    }
}
