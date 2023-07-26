<?php

use App\Database\Migration;

class AddComplexesList extends Migration
{
    // protected $tableName = 'complexes'; // ЖК
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function up()
    {
        try {
            $createQuery = "
                INSERT INTO complexes (name, soundex_code, district_id) 
                VALUES
                ('Зеленый берег', SOUNDEX('Зеленый берег'), 1),
                ('Фонтанная роса', SOUNDEX('Фонтанная роса'), 2);
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