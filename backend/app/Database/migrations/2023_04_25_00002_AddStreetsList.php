<?php

use App\Database\Migration;

class AddStreetsList extends Migration
{
    // protected $tableName = 'streets'; // улицы
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function up()
    {
        try {
            $createQuery = "
                INSERT INTO streets (name, soundex_code) 
                VALUES
                ('Парковая', SOUNDEX('Парковая')),
                ('Сиреневая', SOUNDEX('Сиреневая')),
                ('Лесная', SOUNDEX('Лесная')),
                ('Цветочная', SOUNDEX('Цветочная')),
                ('Невская', SOUNDEX('Невская')),
                ('Фонтанов', SOUNDEX('Фонтанов')),
                ('Греческая', SOUNDEX('Греческая')),
                ('Канала', SOUNDEX('Канала')),
                ('Зеленоградская', SOUNDEX('Зеленоградская')),
                ('Московская', SOUNDEX('Московская'))
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