<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTaxDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_tax_documents', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('user_id')->default(1);
            $table->string('title')->nullable();
            $table->string('additional_link')->nullable();
            $table->longText('notes')->nullable();
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
