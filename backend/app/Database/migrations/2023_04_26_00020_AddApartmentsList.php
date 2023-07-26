<?php

use App\Database\Migration;

class AddapartmentsList extends Migration
{
    // protected $tableName = 'apartments'; // квартиры
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function up()
    {
        try {
            $createQuery = "
            -- Дом 1
            INSERT INTO apartments (building_id, floor, rooms, area, rent_price) VALUES
              (1, 1, 2, 50.5, 15000.00),
              (1, 2, 3, 75.0, 22000.00),
              -- Дом 2
              (2, 1, 1, 35.0, 12000.00),
              (2, 2, 2, 55.5, 18000.00),
              -- Дом 3
              (3, 1, 3, 80.0, 25000.00),
              (3, 2, 2, 65.0, 20000.00),
              -- Дом 4
              (4, 1, 1, 40.0, 13000.00),
              (4, 2, 2, 60.0, 19000.00),
              -- Дом 5
              (5, 1, 2, 55.5, 18000.00),
              (5, 2, 3, 75.0, 22000.00),
              -- Дом 6
              (6, 1, 1, 35.0, 12000.00),
              (6, 2, 2, 60.0, 19000.00),
              -- Дом 7
              (7, 1, 3, 80.0, 25000.00),
              (7, 2, 2, 65.0, 20000.00),
              -- Дом 8
              (8, 1, 1, 40.0, 13000.00),
              (8, 2, 2, 55.5, 18000.00)
              ;
            ";

            $statement = $this->pdo->prepare($createQuery);
            $statement->execute();
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