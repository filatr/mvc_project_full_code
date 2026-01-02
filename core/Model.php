<?php

require_once __DIR__ . '/Database.php';

abstract class Model
{
    /**
     * @var PDO
     */
    protected PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}
