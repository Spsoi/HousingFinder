<?php 

namespace App\Validation;

use App\Models\Apartments;
use App\Models\BaseModel;
use App\Models\Buildings;
use App\Models\Cities;
use App\Models\Complexes;
use App\Models\Districts;
use App\Models\Streets;
use App\Validation\BaseValidator;

class ApartmentValidator extends BaseValidator
{
    public function __construct ($validateData) {
        $this->validateData = $validateData;
    }

    public function validateRequredCityId() {

        $key = 'city_id';

        $this->validateInteger($key);

        $city = (new Cities)->find($this->validateData[$key]);

        if (empty($city)) {
            throw new \InvalidArgumentException("Field '$key' not found.", 404);
        }
    }
    
    public function validateRequredDistrictId() {

        $key = 'district_id';
        
        $this->validateInteger($key);

        $city = (new Districts)->find($this->validateData[$key]);

        if (empty($city)) {
            throw new \InvalidArgumentException("Field '$key' not found.", 404);
        }
    }

    public function validateRequredStreetId() {

        $key = 'street_id';
        
        $this->validateInteger($key);

        $city = (new Streets)->find($this->validateData[$key]);

        if (empty($city)) {
            throw new \InvalidArgumentException("Field '$key' not found.", 404);
        }
    }

    public function validateRequredComplexId() {

        $key = 'complex_id';
        
        $this->validateInteger($key);

        $city = (new Complexes)->find($this->validateData[$key]);

        if (empty($city)) {
            throw new \InvalidArgumentException("Field '$key' not found.", 404);
        }
    }

    public function validateRequredBuildingId() {

        $key = 'building_id';
        
        $this->validateInteger($key);

        $city = (new Buildings)->find($this->validateData[$key]);

        if (empty($city)) {
            throw new \InvalidArgumentException("Field '$key' not found.", 404);
        }
    }

    public function validateCorpus() {

        $key = 'corpus';
        
        if (empty($this->validateData['corpus'])) {
            return true;
        }

        $baseModel = new BaseModel();
        $distictTable   = Districts::getTableName();
        $query = "
            SELECT *
            FROM `$distictTable`
            WHERE `$distictTable`.`id` = :building_id AND `$distictTable`.`corpus` = :corpus
        ";

        $params['building_id'] = $this->validateData['building_id'];
        $params['corpus'] = !empty($this->validateData['corpus']) ? strip_tags($this->validateData['corpus']) : null ;

        $apartment = $baseModel->findByQuerySingle($query, $params);

        if (empty($apartment)) {
            throw new \InvalidArgumentException("Field '$key' not found.", 404);
        }
    }

    public function validateRequredTotalFloor() {

        $key = 'total_floors';
        
        $this->validateInteger($key);
    }

    public function validateRequredFloor() {

        $key = 'floor';
        
        $this->validateInteger($key);
    }

    public function validateRequredRooms() {

        $key = 'rooms';
        
        $this->validateInteger($key);
    }

    public function validateRequredArea() {

        $key = 'area';
        
        $this->validateNumeric($key);
    }

    public function validateRequredRentPrice() {

        $key = 'rent_price';
        
        $this->validateNumeric($key);
    }
    
}