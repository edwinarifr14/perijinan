<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePelangganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->increments('pelanggan_id');
            $table->string('pelanggan_email', 191)->unique();
            $table->string('pelanggan_password', 255);
            $table->string('pelanggan_nama', 40);
            $table->string('pelanggan_kontak', 20);
            $table->string('pelanggan_alamat');
            $table->integer('pelanggan_city')->unsigned();
            $table->integer('pelanggan_province')->unsigned();
            $table->double('saldo')->default('0');

            $table
                ->foreign('pelanggan_city')
                ->references('id')
                ->on('city')
                ->onUpdate('cascade');
            $table
                ->foreign('pelanggan_province')
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
        Schema::dropIfExists('pelanggan');
    }
}
