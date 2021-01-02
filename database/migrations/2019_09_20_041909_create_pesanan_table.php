<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->increments('pesanan_id');
            $table->unsignedInteger('pesanan_pelanggan');
            $table->unsignedInteger('pesanan_penjual');
            $table->unsignedInteger('pesanan_produk');
            $table->integer('pesanan_jumlah');
            $table->dateTime('pesanan_waktu')->useCurrent();
            $table->enum('pesanan_status', ['Sukses', 'Belum Selesai'])
            ->default('Belum Selesai');
            $table->string('pesanan_tujuan');
            $table->string('pesanan_dari');
            $table->double('pesanan_harga');
            $table->foreign('pesanan_pelanggan')
                ->references('pelanggan_id')
                ->on('pelanggan')
                ->onUpdate('cascade');
                ->onDelete('cascade');
            $table->foreign('pesanan_produk')
                ->references('pemilik')
                ->on('produk')
                ->onUpdate('cascade');
                ->onDelete('cascade');
            $table->foreign('pesanan_produk')
                ->references('produk_id')
                ->on('produk')
                ->onUpdate('cascade');
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesanan');
    }
}
