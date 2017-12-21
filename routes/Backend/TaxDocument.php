<?php

Route::group([
    'namespace'  => 'TaxDocument',
], function () {

    Route::get('tax-documents/get', 'AdminTaxDocumentController@getTableData')->name('tax-documents.get-list-data');
    /*
     * Admin Team Controller
     */
    Route::resource('tax-documents', 'AdminTaxDocumentController');

    Route::get('tax-documents/', 'AdminTaxDocumentController@index')->name('tax-documents.index');
});
