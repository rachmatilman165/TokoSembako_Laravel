<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanStoksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporan_stoks', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_produk');
            $table->integer('stok_awal');
            $table->integer('barang_masuk');
            $table->integer('barang_keluar');
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
        Schema::dropIfExists('laporan_stoks');
    }
}
