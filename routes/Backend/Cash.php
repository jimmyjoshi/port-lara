<?php

Route::group([
    'namespace'  => 'Cash',
], function () {

    Route::get('cash/get', 'AdminCashController@getTableData')->name('cash.get-list-data');
    /*
     * Admin Cash Controller
     */
    Route::resource('cash', 'AdminCashController');

    Route::get('cash/', 'AdminCashController@index')->name('cash.index');
});
