<?php

Route::group([
    'namespace'  => 'DocumentCategory',
], function () {

    Route::get('document-categories/get', 'AdminDocumentCategoryController@getTableData')->name('document-categories.get-list-data');
    /*
     * Admin Team Controller
     */
    Route::resource('document-categories', 'AdminDocumentCategoryController');

    Route::get('document-categories/', 'AdminDocumentCategoryController@index')->name('document-categories.index');
});
