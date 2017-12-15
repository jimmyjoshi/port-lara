<?php

Route::group([
    'namespace'  => 'Upload',
], function () {

    Route::get('uploads/get', 'AdminUploadController@getTableData')->name('uploads.get-list-data');
    /*
     * Admin Upload Controller
     */
    Route::resource('uploads', 'AdminUploadController');

    Route::get('uploads/', 'AdminUploadController@index')->name('uploads.index');
});
