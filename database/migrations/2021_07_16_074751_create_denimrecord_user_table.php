<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDenimrecordUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denim_record_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('denim_record_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('denim_record_id')->references('id')->on('denim_records')->onDelete('cascade');
            $table->unique(['user_id', 'denim_record_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('denim_record_user');

        // Schema::table('denim_record_user', function (Blueprint $table) {
        //     $table->dropForeign('denim_record_user_user_id_foreign');
        //     $table->dropForeign('denim_record_user_denim_record_id_foreign');
        //     $table->dropColumn('denim_record_id');
        //     $table->dropColumn('user_id');
        // });
    }
}
