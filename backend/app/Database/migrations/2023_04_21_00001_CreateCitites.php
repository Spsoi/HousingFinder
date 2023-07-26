<?php

use App\Database\Migration;

class CreateCitites extends Migration
{
    protected $tableName = 'cities'; // город
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function up()
    {
        try {
            $createQuery = "
                CREATE TABLE {$this->tableName} (
                    id INT PRIMARY KEY AUTO_INCREMENT,
                    name VARCHAR(255) NOT NULL,
                    soundex_code VARCHAR(4) NOT NULL,
                    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                    deleted_at TIMESTAMP NULL
                );
            ";

            $statement = $this->pdo->prepare($createQuery);
            $statement->execute();

            echo "Table {$this->tableName} created successfully.";
        } catch (PDOException $e) {
            echo "Error creating table: " . $e->getMessage();
        }
    }

    public function down()
    {
        try {
            $dropQuery = "DROP TABLE IF EXISTS {$this->tableName}";
            $this->pdo->exec($dropQuery);
            echo "Table {$this->tableName} dropped successfully.";
        } catch (PDOException $e) {
            echo "Error dropping table: " . $e->getMessage();
        }
    }
}