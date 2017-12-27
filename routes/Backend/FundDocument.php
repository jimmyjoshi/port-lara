<?php

Route::group([
    'namespace'  => 'FundDocument',
], function () {

    Route::get('fund-documents/get', 'AdminFundDocumentController@getTableData')->name('fund-documents.get-list-data');
    
    /*
     * Admin Fund Note
     */
    Route::resource('fund-documents', 'AdminFundDocumentController');

    Route::get('fund-documents/', 'AdminFundDocumentController@index')->name('fund-documents.index');
});
