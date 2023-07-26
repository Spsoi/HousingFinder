<?php

namespace App\Services\Apartment;

use App\Database\DB;
use App\Models\Apartments;
use App\Validation\ApartmentValidator;
use App\Models\Buildings;
use App\Models\Cities;
use App\Models\Complexes;
use App\Models\Districts;
use App\Models\Streets;
use PDO;

class AddService
{
    public static $pdo;

    public function __construct () {
        static::$pdo = DB::getInstance(); // подключаем базу данных
    }

    public static function addApartment(array $apartmentData)
    {
        $validate = new ApartmentValidator($apartmentData);

        $validate->validateRequredCityId();
        $validate->validateRequredDistrictId();
        $validate->validateRequredStreetId();
        $validate->validateRequredComplexId();
        $validate->validateRequredBuildingId();
        $validate->validateCorpus();
        $validate->validateRequredTotalFloor();
        $validate->validateRequredFloor();
        $validate->validateRequredRooms();
        $validate->validateRequredArea();
        $validate->validateRequredRentPrice();
        
        $apartmentTable = Apartments::getTableName();
        $query = "
            INSERT INTO `$apartmentTable` (
                `building_id`,
                `floor`,
                `rooms`,
                `area`,
                `rent_price`
            )
            VALUES (
                :building_id,
                :floor,
                :rooms,
                :area,
                :rent_price
            )
        ";

        $params = [
            'building_id' => $apartmentData['building_id'],
            'floor' => $apartmentData['floor'],
            'rooms' => $apartmentData['rooms'],
            'area' => $apartmentData['area'],
            'rent_price' => $apartmentData['rent_price']
        ];

        $stmt = self::$pdo->prepare($query);
        $stmt->execute($params);
        
        return self::$pdo->lastInsertId();
    }
}