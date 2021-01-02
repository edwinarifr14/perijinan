<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city', function (Blueprint $table) {
          $table->integer('id')->unsigned();
          $table->primary('id');
          $table->string('name',200);
          $table->integer('id_province')->unsigned();
          $table->timestamps();
          $table
              ->foreign('id_province')
              ->references('id')
              ->on('province')
              ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city');
    }
}
