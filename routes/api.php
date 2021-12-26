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
            Route::get('/roles', 'UserController@getUserRoles');
            Route::get('/{id}', 'UserController@getSingleUser');

            Route::group(['prefix' => 'address'], function () {
                Route::post('/all', 'UserAddressController@getUserAllAddresses');
                Route::post('/add', 'UserAddressController@addUserAddress');
                Route::post('/edit', 'UserAddressController@editUserAddress');
                Route::post('/delete', 'UserAddressController@deleteUserAddress');
            });

            Route::group(['prefix' => 'saved-address'], function () {
                Route::post('/all', 'UserSavedAddressController@getUserAllSavedAddresses');
                Route::post('/add', 'UserSavedAddressController@addUserSavedAddress');
                Route::post('/edit', 'UserSavedAddressController@editUserSavedAddress');
                Route::post('/delete', 'UserSavedAddressController@deleteUserSavedAddress');
            });

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

            Route::group(['prefix' => 'academic'], function () {
                Route::post('/all', 'UserAcademicController@getUserAllAcadmicData');
                Route::post('/add', 'UserAcademicController@addUserAcadmicData');
                Route::post('/edit', 'UserAcademicController@editUserAcadmicData');
                Route::post('/delete', 'UserAcademicController@deleteUserAcadmicData');
            });

            Route::group(['prefix' => 'other-info'], function () {
                Route::post('/all', 'UserOtherInfoController@getUserAllOtherInfoData');
                Route::post('/add', 'UserOtherInfoController@addUserOtherInfo');
                Route::post('/edit', 'UserOtherInfoController@editUserOtherInfo');
                Route::post('/delete', 'UserOtherInfoController@deleteUserOtherInfo');
            });

        });
    });
});

