<?php

Route::group([
    'namespace'  => 'Entity',
], function () {

    Route::get('entities/get', 'AdminEntityController@getTableData')->name('entities.get-list-data');
    Route::post('entities/get-by-user-id', 'AdminEntityController@getAllByUserId')->name('entities.get-by-user-id');
    
    /*
     * Admin Entity Controller
     */
    Route::resource('entities', 'AdminEntityController');

    Route::get('entities/', 'AdminEntityController@index')->name('entities.index');
});
