<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPenjualanTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('transaksi_id');
            $table->date('tanggal');
            $table->unsignedBigInteger('konsumen_id');
            $table->string('produk');
            $table->decimal('total', 15, 2);
            $table->decimal('keuntungan', 15, 2);
            $table->timestamps();

            $table->foreign('konsumen_id')->references('id')->on('konsumens')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_penjualan');
    }
}
