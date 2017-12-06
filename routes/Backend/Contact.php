<?php

Route::group([
    'namespace'  => 'Contact',
], function () {

    Route::get('contacts/get', 'AdminContactController@getTableData')->name('contacts.get-list-data');
    /*
     * Admin Team Controller
     */
    Route::resource('contacts', 'AdminContactController');

    Route::get('contacts/', 'AdminContactController@index')->name('contacts.index');
});
