<?php

use App\Database\Migration;

class CreateBuildings extends Migration
{
    protected $tableName = 'buildings'; // Дома, здания
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
                id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
                complex_id INT NOT NULL,
                street_id INT NOT NULL,
                building_number VARCHAR(50) NOT NULL,
                corpus VARCHAR(50),
                total_floors INT NOT NULL,
                entrances INT NOT NULL,
                apartments_count INT NOT NULL,
                apartment_number_from INT NOT NULL,
                apartment_number_to INT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                deleted_at TIMESTAMP NULL,
                FOREIGN KEY (complex_id) REFERENCES complexes(id),
                FOREIGN KEY (street_id) REFERENCES streets(id)
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