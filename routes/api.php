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
        Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
            Route::get('/list', 'UserController@getUsers');
            Route::post('/list-by-role', 'UserController@getUsersByRole');
            Route::get('/{id}', 'UserController@getSingleUser');

            Route::group(['prefix' => 'service'], function () {
                Route::post('/all', 'UserServiceController@getUserAllServices');
                Route::post('/add', 'UserServiceController@addUserService');
                Route::post('/edit', 'UserServiceController@editUserService');
                Route::post('/delete', 'UserServiceController@deleteUserService');
            });

            Route::group(['prefix' => 'professional-data'], function () {
                Route::post('/all', 'UserProfessionalDataController@getUserAllProfData');
                Route::post('/add', 'UserProfessionalDataController@addUserProfData');
                Route::post('/edit', 'UserProfessionalDataController@editUserProfData');
                Route::post('/delete', 'UserProfessionalDataController@deleteUserProfData');
            });
        });
    });
});
