<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('transaksi_id');
            $table->unsignedInteger('transaksi_pelanggan')->nullable();
            $table->string('transaksi_to', 20);
            $table->double('transaksi_nominal');
            $table->string('transaksi_bank', 20);
            $table->dateTime('transaksi_waktu')->useCurrent();
            $table->enum('transaksi_bayar', ['Sudah Dibayar', 'Belum Dibayar'])
                ->default('Belum Dibayar');
            $table->string('transaksi_deskripsi', 30);
            $table->string('gambar')->nullable();

            $table->foreign('transaksi_pelanggan')
                ->references('pelanggan_id')
                ->on('pelanggan')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
