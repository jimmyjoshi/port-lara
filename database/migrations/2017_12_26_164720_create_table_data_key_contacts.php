<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataKeyContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_key_contacts', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('fund_id')->default(1);
            $table->string('title')->nullable();
            $table->string('company')->nullable();
            $table->string('designation')->nullable();
            $table->string('contact_number')->nullable();
            $table->longText('description')->nullable();
            $table->string('email_id')->nullable();
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
