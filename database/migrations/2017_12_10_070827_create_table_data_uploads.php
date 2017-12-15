<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataUploads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_uploads', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('category_id')->default(1);
            $table->string('title')->nullable();
            $table->string('upload_file')->nullable();
            $table->longText('external_link')->nullable();
            $table->integer('doc_type')->default(1);
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
