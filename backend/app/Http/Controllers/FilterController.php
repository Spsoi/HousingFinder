<?php

namespace App\Http\Controllers;

use App\Services\Filter\FilterService;
use App\Http\Request\Request;

class FilterController extends BaseController
{
    public function getPhoneticAll()
    {
        $phoneticQuery = $this->getArrayStream()['phonetic'];
        $service = (new FilterService)->phoneticSearchAllTables($phoneticQuery);
        response($service);
    }
}