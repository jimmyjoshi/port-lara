<?php

Route::group([
    'namespace'  => 'FundNote',
], function () {

    Route::get('fund-notes/get', 'AdminFundNoteController@getTableData')->name('fund-notes.get-list-data');
    
    /*
     * Admin Fund Note
     */
    Route::resource('fund-notes', 'AdminFundNoteController');

    Route::get('fund-notes/', 'AdminFundNoteController@index')->name('fund-notes.index');
});
