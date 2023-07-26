<?php

namespace App\Database;

use PDO;
use PDOException;

class DB
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        try {
            $dsn = 'mysql:host=' . env('DB_HOST');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            $this->connection = new PDO($dsn, $username, $password, $options);
            
            $databaseName = env('DB_DATABASE');// Проверяем наличие базы данных, и создаем ее, если она не существует
            $query = "CREATE DATABASE IF NOT EXISTS $databaseName";
            $this->connection->exec($query);

            // Переключаемся на использование этой базы данных
            $this->connection->exec("USE $databaseName");

        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance->connection;
    }
}