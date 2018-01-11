<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTeamMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_teams_members', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('team_id')->default(1);
            $table->string('title')->nullable();
            $table->string('designation')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('profile_picture')->nullable();
            $table->longText('description')->nullable();
            $table->integer('status')->default(1);
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
