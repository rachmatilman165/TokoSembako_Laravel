<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualan extends Model
{
    use HasFactory;

    protected $table = 'laporan_penjualan';

    protected $fillable = [
        'transaksi_id',
        'tanggal',
        'konsumen_id',
        'produk_id',
        'produk',
        'total',
        'keuntungan',
    ];

    // public function konsumen()
    // {
    //     return $this->belongsTo(\App\Models\Konsumen::class, 'konsumen_id');
    // }

    public function prodek()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
