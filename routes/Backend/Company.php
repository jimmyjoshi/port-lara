<?php

Route::group([
    'namespace'  => 'Company',
], function () {

    Route::get('company/get', 'AdminCompanyController@getTableData')->name('company.get-list-data');
    /*
     * Admin ToDo Controller
     */
    Route::resource('company', 'AdminCompanyController');

    Route::get('company/', 'AdminCompanyController@index')->name('company.index');
});
