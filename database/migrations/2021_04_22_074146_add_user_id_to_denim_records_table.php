<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToDenimRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denim_records', function (Blueprint $table) {
          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('denim_records', function (Blueprint $table) {
          $table->dropForeign('denim_records_user_id_foreign');
          $table->dropColumn('user_id');
        });
    }
}
