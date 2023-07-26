<?php

namespace App\Services\City;

use App\Database\DB;
use App\Models\Apartments;
use App\Validation\ApartmentValidator;
use App\Models\Buildings;
use App\Models\Cities;
use App\Models\Complexes;
use App\Models\Districts;
use App\Models\Streets;
use PDO;

class CityService
{
    public static $pdo;

    public function __construct () {
        static::$pdo = DB::getInstance();
    }

    public static function getAll()
    {
        $tableName = Cities::getTableName();
        $query = "
            SELECT id, name
            FROM $tableName
            WHERE deleted_at is null;
        ";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById(int $id) : array
    {
        $tableName = Cities::getTableName();
        $query = "
            SELECT id, name
            FROM $tableName
            WHERE deleted_at is null AND `$tableName`.`id` = $id;
        ";
        $stmt = self::$pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}