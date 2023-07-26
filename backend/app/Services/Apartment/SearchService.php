<?php

namespace App\Services\Apartment;

use App\Database\DB;
use App\Models\Apartments;
use App\Models\Buildings;
use App\Models\Cities;
use App\Models\Complexes;
use App\Models\Districts;
use App\Models\Streets;
use PDO;

class SearchService
{
    public static $pdo;

    public function __construct () {
        static::$pdo = DB::getInstance();
    }

    public static function searchApartment(array $arrData)
    {
        // TODO
    }
}