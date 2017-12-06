<?php

Route::group([
    'namespace'  => 'Team',
], function () {

    Route::get('teams/get', 'AdminTeamController@getTableData')->name('teams.get-list-data');
    /*
     * Admin Team Controller
     */
    Route::resource('teams', 'AdminTeamController');

    Route::get('teams/', 'AdminTeamController@index')->name('teams.index');
});
