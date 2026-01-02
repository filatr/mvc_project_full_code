<?php

class Database
{
    private static ?Database $instance = null;
    private PDO $pdo;

    /**
     * Приватний конструктор — тільки через getInstance()
     */
    private function __construct()
    {
        $dbConfig = require ROOT . '/config/db.php';

        $this->pdo = new PDO(
            $dbConfig['dsn'],
            $dbConfig['user'],
            $dbConfig['password'],
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]
        );
    }

    /**
     * Singleton
     */
    public static function getInstance(): Database
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Повертає PDO
     */
    public function getConnection(): PDO
    {
        return $this->pdo;
    }
}
