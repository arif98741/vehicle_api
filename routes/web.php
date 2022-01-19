<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Auth::routes();

/**
 * Backend Routes For Managing all core functionalities
 */
Route::group([
    'prefix' => 'backend',
    'as' => 'backend.',
    'namespace' => 'Backend',
    'middleware' => 'auth', //backend middleware . user must have to be logged in before using system

], function () {

    Route::get('dashboard', 'AdminController@dashboard')->name('dashboard');
    Route::resource('/user', 'UserController')->except(['show']);

    Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
        Route::resource('/service-category', 'ServiceCategoryController');
    });

    Route::resource('/service', 'ServiceController');

});

Route::get('logoutlink', function () {
    \Illuminate\Support\Facades\Auth::logout();
    return redirect('login');
});

Route::get('pass', function () {
    echo Hash::make('123');
});


