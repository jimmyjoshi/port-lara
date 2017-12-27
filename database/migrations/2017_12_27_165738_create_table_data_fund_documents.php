<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataFundDocuments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_fund_documents', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('fund_id')->default(1);
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('additional_link')->nullable();
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
