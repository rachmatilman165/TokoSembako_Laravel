<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk')->unique();
            $table->string('nama_produk');
            $table->decimal('harga', 15, 2);
            $table->integer('stok');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->timestamps();

            // Remove foreign key constraint for supplier_id because supplier table does not exist yet
            // $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk');
    }
}
