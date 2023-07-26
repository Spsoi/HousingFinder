<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Database\DB;
use PDO;

class Streets extends BaseModel
{
    protected static $table = 'streets';


    public function getPhoneticAll(string $searchQuerySoundex)
    {
        $sql = "
            SELECT 
                s.id AS street_id,
                s.name AS street_name
            FROM ".static::$table ." AS s
            WHERE s.soundex_code = :querySoundexStreet
        ";
        
        $params = [
            'querySoundexStreet' => $searchQuerySoundex,
        ];
        
        return $this->findByQueryMultiple($sql, $params);
    }
}