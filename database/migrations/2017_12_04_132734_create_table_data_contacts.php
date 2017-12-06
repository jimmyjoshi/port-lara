<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_contacts', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('designation')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('profile_picture')->default('default.png');
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
