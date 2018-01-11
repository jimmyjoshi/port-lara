<?php

Route::group([
    'namespace'  => 'TeamMember',
], function () {

    Route::get('team-members/get', 'AdminTeamMemberController@getTableData')->name('team-members.get-list-data');
    /*
     * Admin Team Controller
     */
    Route::resource('team-members', 'AdminTeamMemberController');

    Route::get('team-members/', 'AdminTeamMemberController@index')->name('team-members.index');
});
