<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToTeamMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_teams_members', function (Blueprint $table) 
        {
            $table->string('address')->nullable()->after('profile_picture');
            $table->string('city')->nullable()->after('address');
            $table->string('zip')->nullable()->after('city');
            $table->string('state')->nullable()->after('zip');
            $table->string('email_id')->nullable()->after('state');
            $table->string('website')->nullable()->after('email_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
