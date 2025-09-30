<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanStok extends Model
{
    use HasFactory;

    protected $table = 'laporan_stoks';

    protected $fillable = [
        'kode',
        'nama_produk',
        'stok_awal',
        'barang_masuk',
        'barang_keluar',
        'stok_akhir',
    ];
}
