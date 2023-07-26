<?php

namespace App\Http\Controllers;

use App\Services\Street\StreetService;

class StreetController extends BaseController
{
    public function getPhoneticAll()
    {
        $phoneticQuery = $this->getPost()['phonetic'];
        $service = (new StreetService)->phoneticSearchAllTables($phoneticQuery);
        response($service);
    }
}