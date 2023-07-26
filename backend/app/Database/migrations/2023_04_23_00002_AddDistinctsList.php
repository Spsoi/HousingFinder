<?php

use App\Database\Migration;

class AddDistinctsList extends Migration
{
    // protected $tableName = 'districts'; // район
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function up()
    {
        try {
            $createQuery = "
                INSERT INTO districts (name, soundex_code, city_id) 
                VALUES
                ('Зеленоградский район', SOUNDEX('Зеленоградский район'), 1),
                ('Чкаловский район', SOUNDEX('Чкаловский район'), 2);
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