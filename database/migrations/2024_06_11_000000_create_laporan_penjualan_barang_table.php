<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPenjualanBarangTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_penjualan_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->integer('jumlah_terjual');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('keuntungan', 15, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_penjualan_barang');
    }
}
