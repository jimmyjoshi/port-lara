<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_teams', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('designation')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('profile_picture')->default('default.png');
            $table->integer('category')->default(1);
            $table->timestamps();
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
