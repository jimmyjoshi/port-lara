<?php

Route::group([
    'namespace'  => 'FundDocument',
], function () {

    Route::get('company-documents/get', 'AdminFundDocumentController@getTableData')->name('company-documents.get-list-data');
    
    /*
     * Admin Fund Note
     */
    Route::resource('company-documents', 'AdminFundDocumentController');

    Route::get('company-documents/', 'AdminFundDocumentController@index')->name('company-documents.index');
});
