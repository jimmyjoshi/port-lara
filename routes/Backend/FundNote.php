<?php

Route::group([
    'namespace'  => 'FundNote',
], function () {

    Route::get('company-notes/get', 'AdminFundNoteController@getTableData')->name('company-notes.get-list-data');
    
    /*
     * Admin Company Note
     */
    Route::resource('company-notes', 'AdminFundNoteController');

    Route::get('company-notes/', 'AdminFundNoteController@index')->name('company-notes.index');
});
