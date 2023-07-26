<?php 

namespace App\Validation;

class BaseValidator
{
    protected $validateData;

    public function validateNumeric(string $key) 
    {
        if (!isset($this->validateData[$key])) {
            throw new \InvalidArgumentException("Field '$key' is required.", 422);
        }

        if (isset($this->validateData[$key]) && !is_numeric(floatval($this->validateData[$key]))) {
            throw new \InvalidArgumentException("Field '$key' must be numeric.", 422);
        }
    }

    public function validateInteger(string $key) 
    {
        if (!isset($this->validateData[$key])) {
            throw new \InvalidArgumentException("Field '$key' is required.", 422);
        }

        if (isset($this->validateData[$key]) && !is_int(intval($this->validateData[$key]))) {
            throw new \InvalidArgumentException("Field '$key' must be integer.", 422);
        }
    }

    public function validateRequireFields()
    {
        $requiredFields = [
            'city_id', 
            'district_id', 
            'street_id', 
            'complex_id', 
            'building_id', 
            'total_floors', 
            'floor', 
            'rooms', 
            'area', 
            'rent_price'
        ]; /// TODO убрать!

        foreach ($requiredFields as $field) {
            if (!isset($this->validateData[$field])) {
                throw new \InvalidArgumentException("Field '$field' is required.");
            }
        }
    }
}