<?php

use App\Database\RunMigration;
use App\Http\Route\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\CityController;

Route::get('/', [BaseController::class, 'response']);
Route::get('/run/migration', [RunMigration::class, 'runMigration']);

// apartment
Route::post('/api/search/apartment',    [ApartmentController::class, 'searchApartment']);
Route::post('/api/add/apartment',       [ApartmentController::class, 'addApartment']);

// 
Route::get('/api/cities/list',          [CityController::class, 'list']);
Route::post('/api/cities/item',         [CityController::class, 'item']);

// 
Route::post('/api/phonetic/filter',     [FilterController::class, 'getPhoneticAll']);

$routes = Route::routes();