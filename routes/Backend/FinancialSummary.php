<?php

Route::group([
    'namespace'  => 'FinancialSummary',
], function () {

    Route::get('financial-summary/get', 'AdminFinancialSummaryController@getTableData')->name('financial-summary.get-list-data');
    /*
     * Admin Team Controller
     */
    Route::resource('financial-summary', 'AdminFinancialSummaryController');

    Route::get('financial-summary/', 'AdminFinancialSummaryController@index')->name('financial-summary.index');
});
