<?php

namespace App\Services\Street;

use App\Database\DB;
use App\Models\Apartments;
use App\Models\Buildings;
use App\Models\Cities;
use App\Models\Complexes;
use App\Models\Districts;
use App\Models\Streets;
use PDO;

class StreetService
{
    public static $pdo;

    public function __construct () {
        static::$pdo = DB::getInstance(); // подключаем базу данных
    }

    function phoneticSearchAllTables($inputString) {
        $searchQuerySoundex =   $this->stringToSQLSoundex($inputString);
   
        $apartmentTable = Apartments::getTableName();
        $buildingTable  = Buildings::getTableName();
        $cityTable      = Cities::getTableName();
        $complexTable   = Complexes::getTableName();
        $distictTable   = Districts::getTableName();
        $streetsTable   = Streets::getTableName();

        $sql = "
            SELECT 
                s.id AS city_id,
                s.name AS city_name
            FROM $streetsTable s
                LEFT JOIN $buildingTable b ON s.id = b.street_id
                LEFT JOIN $complexTable cx ON b.complex_id = cx.id
            WHERE s.soundex_code = :querySoundexStreet
                OR cx.soundex_code = :querySoundexComplex
        ";
    
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute([
            'querySoundexCity'      => $searchQuerySoundex,
            'querySoundexDistrict'  => $searchQuerySoundex,
            'querySoundexComplex'   => $searchQuerySoundex,
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    function stringToSQLSoundex(string $inputString) {
        // TODO вынести в сервис
        $sql = "SELECT SOUNDEX(:inputString) AS soundex_code";
        $stmt = static::$pdo->prepare($sql);
        $stmt->execute([':inputString' => $inputString]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['soundex_code'];
    }
}