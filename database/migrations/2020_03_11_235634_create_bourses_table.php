<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bourses', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('title');
          $table->text('content');
          $table->string('place');
          $table->string('status')->default('unpublished');
          $table->date('start_date');
          $table->date('end_date');
          $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('bourses');
    }
}
