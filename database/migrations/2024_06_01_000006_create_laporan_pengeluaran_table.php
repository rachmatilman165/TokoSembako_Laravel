<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporanPengeluaranTable extends Migration
{
    public function up()
    {
        Schema::create('laporan_pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('kategori');
            $table->decimal('total', 15, 2);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('laporan_pengeluaran');
    }
}
