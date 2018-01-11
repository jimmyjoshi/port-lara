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
    Route::any('forgotpassword', 'UsersController@forgotPassword')->name('api.forgotPassword');
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


    //Route::get('get-team-members', 'APITeamController@index')->name('api.get-team-members');
    Route::get('get-team-members', 'APIMasterController@getAllTeamMembers')->name('api.get-team-members');
    Route::post('get-team-details', 'APIMasterController@getTeamDetails')->name('api.get-team-details');
    Route::get('get-contacts', 'APITeamController@getContacts')->name('api.get-contacts');

    Route::get('document-categories', 'APIMasterController@getDocumentCategories')->name('api.get-document-categories');
    Route::get('get-documents', 'APIMasterController@getAllDocuments')->name('api.get-all-documents');

    Route::get('get-all-entities', 'APIMasterController@getAllEntities')->name('api.get-all-entities');

    Route::get('get-all-todos', 'APIMasterController@getAllTodos')->name('api.get-all-todos');
    Route::post('create-todos', 'APIMasterController@createTodos')->name('api.create-todos');
    Route::post('update-todos', 'APIMasterController@updateTodos')->name('api.update-todos');

    Route::get('get-all-tax-documents', 'APIMasterController@getAllTaxDocuments')->name('api.get-all-tax-documents');
    Route::get('get-all-financial-statements', 'APIMasterController@getAllFinancialStatments')->name('api.get-all-financial-statements');

    Route::get('get-all-user-companies', 'APIMasterController@getAllUserCompanies')->name('api.get-all-user-companies');

    Route::get('get-financial-summary', 'APIMasterController@getFinancialSummary')->name('api.get-financial-summary');
    Route::post('get-fund-details', 'APIMasterController@getFundById')->name('api.get-fund-details');
    Route::post('get-documents-by-category', 'APIMasterController@getAllDocumentsByCategoryId')->name('api.get-documents-by-category');
    
    Route::any('get-news', 'APIMasterController@getGoogleNews')->name('api.get-google-news');   
});