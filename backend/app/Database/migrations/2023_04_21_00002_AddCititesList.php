<?php

use App\Database\Migration;

class AddCititesList extends Migration
{
    // protected $tableName = 'cities';
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function up()
    {
        try {
            $createQuery = "
                INSERT INTO cities (name, soundex_code, created_at, updated_at, deleted_at)
                VALUES
                ('Москва', SOUNDEX('Москва'), CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
                ('Санкт-Петербург', SOUNDEX('Санкт-Петербург'), CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL),
                ('Зеленоград', SOUNDEX('Зеленоград'), CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, NULL)
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