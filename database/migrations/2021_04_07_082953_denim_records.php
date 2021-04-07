<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DenimRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denim_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('denim_id');
            $table->date('wearing_day');
            $table->string('wearing_place')->nullable();
            $table->text('body')->nullable();
            $table->foreign('denim_id')->references('id')->on('denims');
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
        Schema::dropIfExists('denim_records');
    }
}
