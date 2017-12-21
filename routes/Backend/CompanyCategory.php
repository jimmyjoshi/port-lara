<?php

Route::group([
    'namespace'  => 'CompanyCategory',
], function () {

    Route::get('company-categories/get', 'AdminCompanyCategoryController@getTableData')->name('company-categories.get-list-data');
    /*
     * Admin Team Controller
     */
    Route::resource('company-categories', 'AdminCompanyCategoryController');

    Route::get('company-categories/', 'AdminCompanyCategoryController@index')->name('company-categories.index');
});
