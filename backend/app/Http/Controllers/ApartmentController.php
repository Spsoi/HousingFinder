<?php

namespace App\Http\Controllers;

use App\Services\Apartment\AddService;
use App\Services\Apartment\SearchService;
use App\Http\Request\Request;

class ApartmentController extends BaseController
{
    public function addApartment()
    {
        $paramAdd = $this->getPost();
        (new AddService)->addApartment($paramAdd);
    }

    public function searchApartment()
    {
        // $paramSearch = $this->getPost();
        $paramSearch = $this->getArrayStream();
        $apartments = (new SearchService)->searchApartment($paramSearch);
        response($apartments);
    }
}