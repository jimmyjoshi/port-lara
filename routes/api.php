<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api',], function () 
{
    Route::post('login', 'UsersController@login')->name('api.login');
    /*Route::post('register', 'UsersController@register')->name('api.register');
    Route::post('verifyotp', 'UsersController@verifyOtp')->name('api.verifyotp');
    Route::post('resendotp', 'UsersController@resendOtp')->name('api.resendotp');
    Route::post('forgotpassword', 'UsersController@forgotPassword')->name('api.forgotPassword');
    Route::post('specializations', 'SpecializationController@specializationList')->name('api.specializationList');
    Route::post('removeotp', 'UsersController@removeOtp')->name('api.removeotp');
    // send next appointment notification
    Route::post('sendnext', 'PatientsController@sendNextAppoint')->name('api.sendnext');*/
});

Route::group(['namespace' => 'Api', 'middleware' => 'jwt.customauth'], function () 
{
    Route::get('events', 'APIEventsController@index')->name('events.index');
    Route::post('events/create', 'APIEventsController@create')->name('events.create');
    Route::post('events/edit', 'APIEventsController@edit')->name('events.edit');
    Route::post('events/delete', 'APIEventsController@delete')->name('events.delete');
<<<<<<< HEAD
=======


    Route::get('get-team-members', 'APITeamController@index')->name('api.get-team-members');
    Route::get('get-contacts', 'APITeamController@getContacts')->name('api.get-contacts');
>>>>>>> a741c11fe6b07ecca513f8d5274d3ab8ea91685e
});