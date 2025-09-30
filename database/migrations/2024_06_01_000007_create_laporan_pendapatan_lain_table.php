<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPendapatanLainTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_pendapatan_lain', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('sumber_pendapatan');
            $table->decimal('harga', 15, 2);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_pendapatan_lain');
    }
}
