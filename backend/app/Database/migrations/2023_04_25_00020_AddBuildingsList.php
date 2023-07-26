<?php

use App\Database\Migration;

class AddbuildingsList extends Migration
{
    // protected $tableName = 'buildings'; // Дома, здания
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function up()
    {
        try {
            $createQuery = "

            -- Москва
            -- ЖК Парковый
            -- Улица Парковая
           
            INSERT INTO buildings (complex_id, street_id, building_number, corpus, total_floors, entrances, apartments_count, apartment_number_from, apartment_number_to) VALUES
              -- Дом 1
              (1, 1, '1A', NULL, 5, 1, 10, 101, 110),
              (1, 1, '1B', NULL, 8, 2, 18, 201, 218),
              (1, 1, '1C', 'Корпус 1', 6, 1, 12, 301, 312),
              (1, 1, '1D', 'Корпус 1', 7, 2, 20, 401, 420),
              (1, 1, '1E', 'Корпус 2', 9, 2, 22, 501, 522),
              -- Дом 2
              (1, 1, '2A', NULL, 6, 1, 14, 102, 115),
              (1, 1, '2B', NULL, 7, 2, 20, 202, 220),
              (1, 1, '2C', 'Корпус 1', 5, 1, 10, 302, 312),
              (1, 1, '2D', 'Корпус 1', 8, 2, 24, 402, 425),
              (1, 1, '2E', 'Корпус 2', 7, 1, 16, 502, 516),
              -- Дом 3
              (1, 1, '3A', NULL, 10, 2, 28, 201, 228),
              (1, 1, '3B', NULL, 12, 2, 30, 301, 330),
              (1, 1, '3C', 'Корпус 1', 9, 2, 25, 401, 425),
              (1, 1, '3D', 'Корпус 1', 11, 3, 32, 501, 532),
              (1, 1, '3E', 'Корпус 2', 10, 2, 26, 601, 626),
              -- Дом 4
              (1, 1, '4A', NULL, 7, 1, 16, 101, 116),
              (1, 1, '4B', NULL, 8, 2, 22, 201, 222),
              (1, 1, '4C', 'Корпус 1', 6, 1, 12, 301, 312),
              (1, 1, '4D', 'Корпус 1', 9, 2, 24, 401, 424),
              (1, 1, '4E', 'Корпус 2', 8, 1, 18, 501, 518),
              -- Дом 5
              (1, 1, '5A', NULL, 5, 1, 10, 102, 111),
              (1, 1, '5B', NULL, 6, 2, 15, 202, 216),
              (1, 1, '5C', 'Корпус 1', 4, 1, 8, 301, 309),
              (1, 1, '5D', 'Корпус 1', 7, 2, 18, 401, 418),
              (1, 1, '5E', 'Корпус 2', 6, 1, 12, 502, 513),
              -- Дом 6
              (1, 2, '6A', NULL, 8, 1, 18, 101, 118),
              (1, 2, '6B', NULL, 9, 2, 24, 201, 224),
              (1, 2, '6C', 'Корпус 1', 7, 1, 16, 301, 316),
              (1, 2, '6D', 'Корпус 1', 10, 2, 28, 401, 428),
              (1, 2, '6E', 'Корпус 2', 9, 1, 20, 501, 520),
              -- Дом 7
              (1, 2, '7A', NULL, 6, 1, 14, 102, 115),
              (1, 2, '7B', NULL, 7, 2, 20, 202, 220),
              (1, 2, '7C', 'Корпус 1', 5, 1, 10, 301, 310),
              (1, 2, '7D', 'Корпус 1', 8, 2, 24, 401, 424),
              (1, 2, '7E', 'Корпус 2', 7, 1, 16, 501, 516),
              -- Дом 8
              (1, 2, '8A', NULL, 10, 2, 28, 201, 228),
              (1, 2, '8B', NULL, 12, 2, 30, 301, 330),
              (1, 2, '8C', 'Корпус 1', 9, 2, 25, 401, 425),
              (1, 2, '8D', 'Корпус 1', 11, 3, 32, 501, 532),
              (1, 2, '8E', 'Корпус 2', 10, 2, 26, 601, 626)
              
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