<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenimImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denim_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('denim_id');
            $table->text('cloud_image_id')->nullable();
            $table->text('cloud_image_path')->nullable();
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
        Schema::dropIfExists('denim_images');
    }
}
