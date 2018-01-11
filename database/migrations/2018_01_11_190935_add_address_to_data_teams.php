<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAddressToDataTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_teams', function (Blueprint $table) 
        {
            $table->string('address')->nullable()->after('category');
            $table->string('city')->nullable()->after('address');
            $table->string('zip')->nullable()->after('city');
            $table->integer('star')->nullable()->after('zip');
            $table->string('email_id')->nullable()->after('star')->default(0);
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
