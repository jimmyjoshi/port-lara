<?php

Route::group([
    'namespace'  => 'ToDo',
], function () {

    Route::get('todos/get', 'AdminToDoController@getTableData')->name('todos.get-list-data');
    /*
     * Admin ToDo Controller
     */
    Route::resource('todos', 'AdminToDoController');

    Route::get('todos/', 'AdminToDoController@index')->name('todos.index');
});
