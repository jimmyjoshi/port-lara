<?php

Route::group([
    'namespace'  => 'Entity',
], function () {

    Route::get('entities/get', 'AdminEntityController@getTableData')->name('entities.get-list-data');
    
    /*
     * Admin Entity Controller
     */
    Route::resource('entities', 'AdminEntityController');

    Route::get('entities/', 'AdminEntityController@index')->name('entities.index');
});
