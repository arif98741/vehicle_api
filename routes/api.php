<?php

use App\Http\Controllers\Api\V1\RegisterController;
use App\Http\Controllers\Api\V1\SpecialityController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'Api\V1',

    ], function () {

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']);

    Route::middleware('auth:api')->group(function () {

        /**
         * provider api
         */
        Route::group(['prefix' => 'vehicle'], function () {

            Route::post('/add', 'VehicleController@add');
            Route::post('/all', 'VehicleController@all');
            Route::post('/edit/{id}', 'VehicleController@edit');
            Route::post('/delete/{id}', 'VehicleController@delete');
        });
    });
});

