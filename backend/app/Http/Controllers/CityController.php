<?php

namespace App\Http\Controllers;

use App\Services\Apartment\AddService;
use App\Services\City\CityService;
use App\Http\Request\Request;

class CityController extends BaseController
{
    public function list()
    {
        response((new CityService)->getAll());
    }

    public function item()
    {
        $id = $this->getPost()['id'];
        // TODO Exception
        response((new CityService)->getById($id));
    }
}