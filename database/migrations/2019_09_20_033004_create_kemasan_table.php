<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKemasanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemasan', function (Blueprint $table) {
            $table->increments('kemasan_id');
            $table->string('kemasan_kode', 5);
            $table->string('kemasan_deskripsi', 25)->default('Tidak Ada Deskripsi');
            $table->integer('kemasan_gram')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemasan');
    }
}
