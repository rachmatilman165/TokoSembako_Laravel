<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPenjualanBarang extends Model
{
    use HasFactory;

    protected $table = 'laporan_penjualan_barang';

    protected $fillable = [
        'kode',
        'nama',
        'jumlah_terjual',
        'harga_satuan',
        'total',
        'keuntungan',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'kode', 'kode_produk');
    }
}
