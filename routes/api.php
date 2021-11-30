<?php

use App\Http\Controllers\Api\V1\RegisterController;
use Illuminate\Support\Facades\Route;


Route::group(
    [
        'prefix' => 'v1'
    ], function () {

    Route::post('register', [RegisterController::class, 'register']);
    Route::post('login', [RegisterController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('test', function () {
            echo 'hi';
        });

        Route::group(['prefix' => 'user'], function () {
            Route::get('/',function(){});
        });
    });
});
