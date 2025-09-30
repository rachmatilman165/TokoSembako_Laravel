<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonsumensTable extends Migration
{
    public function up()
    {
        Schema::create('konsumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama_konsumen');
            $table->text('alamat');
            $table->string('telepon');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('konsumens');
    }
}
