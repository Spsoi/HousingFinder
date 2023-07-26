<?php

namespace App\Models;

use App\Database\DB;
use PDO;

class BaseModel
{
    protected static $table;
    protected $guarded = ['id'];
    protected $pdo;

    public function __construct () {
        $this->pdo = DB::getInstance(); // подключаем базу данных
    }

    // // Получить все
    // public function all()
    // {
    //     $query = "SELECT * FROM {$this->table}";
    //     $stmt = $this->pdo->query($query);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // // Получить по его ID
    public function find(int $id)
    {
        $query = "SELECT * FROM ".static::$table." WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function findByQuerySingle(string $query, array $params)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function findByQueryMultiple(string $query, array $params)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // protected function findByQuerySingle(string $query, array $params) : array
    // {
    //     $stmt = self::$pdo->prepare($query);
    //     $stmt->execute($params);
    //     return $stmt->fetchAll(PDO::FETCH_ASSOC);
    // }

    // // Создать нового
    // public function create(array $data)
    // {
    //     $keys = implode(', ', array_keys($data));
    //     $values = ':' . implode(', :', array_keys($data));

    //     $query = "INSERT INTO {$this->table} ({$keys}) VALUES ({$values})";
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->execute($data);
    // }

    // // Обновить данные по его ID
    // public function update(int $id, array $data)
    // {
    //     $setValues = '';
    //     foreach ($data as $key => $value) {
    //         $setValues .= "{$key} = :{$key}, ";
    //     }
    //     $setValues = rtrim($setValues, ', ');

    //     $query = "UPDATE {$this->table} SET {$setValues} WHERE id = :id";
    //     $data['id'] = $id;

    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->execute($data);
    // }

    // // Удалить по его ID
    // public function delete(int $id)
    // {
    //     $query = "DELETE FROM {$this->table} WHERE id = :id";
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->execute(['id' => $id]);
    // }
    public static function getTableName() {
        // Внутри методов класса, вы можете обращаться к статическому свойству с помощью self:: или static::
        return static::$table;
    }

    public static function getPDOInstance() {
        // Внутри методов класса, вы можете обращаться к статическому свойству с помощью self:: или static::
        return self::$pdo;
    }
}