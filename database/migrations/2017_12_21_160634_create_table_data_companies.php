<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataCompanies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_companies', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('company_category_id')->default(1);
            $table->integer('user_id')->default(1);
            $table->integer('fund_id')->default(1);
            $table->string('title')->nullable();
            $table->float('amount')->nullable();
            $table->integer('percentage')->default(0);
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
