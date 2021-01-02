<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->increments('produk_id');
            $table->unsignedInteger('produk_kategori');
            $table->unsignedInteger('produk_kemasan');
            $table->string('produk_nama', 40);
            $table->double('produk_harga');
            $table->string('produk_deskripsi')->default('Tidak Ada Deskripsi');
            $table->string('produk_gambar')->nullable();
            $table->integer('produk_stok');
            $table->unsignedInteger('pemilik');

            $table->foreign('produk_kategori')
                ->references('kategori_id')
                ->on('kategori')
                ->onUpdate('cascade');

            $table->foreign('produk_kemasan')
                ->references('kemasan_id')
                ->on('kemasan')
                ->onUpdate('cascade');

            $table->foreign('pemilik')
                ->references('pelanggan_id')
                ->on('pelanggan')
                ->onDelete('cascade')
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
        Schema::dropIfExists('produk');
    }
}
