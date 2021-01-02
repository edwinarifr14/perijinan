<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKeranjangTable extends Migration
{
    public function up()
    {
        Schema::create('keranjang', function (Blueprint $table) {
            $table->increments('keranjang_id');
            $table->unsignedInteger('keranjang_produk');
            $table->unsignedInteger('keranjang_pelanggan');
            $table->integer('keranjang_jumlah')->default(1);

            $table
                ->foreign('keranjang_produk')
                ->references('produk_id')
                ->on('produk')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table
                ->foreign('keranjang_pelanggan')
                ->references('pelanggan_id')
                ->on('pelanggan')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('keranjang');
    }
}
