<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBourseUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bourse_user', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->integer('bourse_id')->unsigned();
          $table->integer('user_id')->unsigned();
          $table->string('status')->default('pending');
          $table->string('age');
          $table->string('graduation');
          $table->integer('tel');
          $table->string('moyenne');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bourse_user');
    }
}
