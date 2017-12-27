<?php

Route::group([
    'namespace'  => 'KeyContact',
], function () {

    Route::get('key-contacts/get', 'AdminKeyContactController@getTableData')->name('key-contacts.get-list-data');
    
    /*
     * Admin Key Contact Controller
     */
    Route::resource('key-contacts', 'AdminKeyContactController');

    Route::get('key-contacts/', 'AdminKeyContactController@index')->name('key-contacts.index');
});
