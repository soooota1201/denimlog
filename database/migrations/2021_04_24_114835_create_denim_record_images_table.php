<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenimRecordImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denim_record_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('denim_record_id');
            $table->text('cloud_record_image_id')->nullable();
            $table->text('cloud_record_image_path')->nullable();
            $table->foreign('denim_record_id')->references('id')->on('denim_records')->onDelete('cascade');
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
        Schema::dropIfExists('denim_record_images');
    }
}
