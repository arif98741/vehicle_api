<?php

use App\Http\Controllers\Api\V1\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'v1',
        'namespace' => 'Api\V1',

    ], function () {

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']);

    Route::middleware('auth:api')->group(function () {

        Route::post('/register/resend-otp', [RegisterController::class, 'resendOtp']);
        Route::post('/register/verify-otp', [RegisterController::class, 'verifyOtp']);

        /**
         * service api
         */
        Route::group(['prefix' => 'service'], function () {
            Route::get('/single/{id}', 'ServiceController@getSingleService');
            Route::get('/all', 'ServiceController@getAllService');
            Route::get('/categories', 'ServiceController@getAllCategories');
            Route::get('/category/{id}', 'ServiceController@getSingleCategory');

        });

        /**
         * provider api
         */
        Route::group(['prefix' => 'provider', 'namespace' => 'Provider'], function () {
            Route::get('/list', 'ProviderController@getProviders');
        });
    });
});
