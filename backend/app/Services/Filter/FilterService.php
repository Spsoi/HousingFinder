<?php

namespace App\Services\Filter;

use App\Database\DB;
use App\Models\Apartments;
use App\Models\Buildings;
use App\Models\Cities;
use App\Models\Complexes;
use App\Models\Districts;
use App\Models\Streets;
use PDO;

class FilterService
{
    public static $pdo;

    public function __construct () {
        static::$pdo = DB::getInstance();
    }

    function phoneticSearchAllTables($inputString) {
        $searchQuerySoundex =   $this->stringToSQLSoundex($inputString);
   
        $buildingTable  = Buildings::getTableName();
        $cityTable      = Cities::getTableName();
        $complexTable   = Complexes::getTableName();
        $distictTable   = Districts::getTableName();
        $streetsTable   = Streets::getTableName();
    
        $sql = "
            SELECT 
                c.id    AS city_id,
                c.name  AS city_name,
                d.id    AS district_id,
                d.name  AS district_name,
                cx.id   AS complex_id,
                cx.name AS complex_name,
                b.id    AS building_id,
                b.building_number  AS building_number,
                b.corpus AS building_corpus,
                b.total_floors AS building_total_floors,
                b.entrances AS building_entrances,
                b.apartments_count AS apartments_count,
                b.apartment_number_from AS apartment_number_from,
                b.apartment_number_to AS apartment_number_to,
                s.id    AS street_id,
                s.name  AS street_name
            FROM $cityTable c
                LEFT JOIN $distictTable d ON c.id = d.city_id
                LEFT JOIN $complexTable cx ON d.id = cx.district_id
                LEFT JOIN $buildingTable b ON cx.id = b.complex_id
                LEFT JOIN $streetsTable s ON b.street_id = s.id
            WHERE c.soundex_code = :querySoundexCity
                OR d.soundex_code = :querySoundexDistrict
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