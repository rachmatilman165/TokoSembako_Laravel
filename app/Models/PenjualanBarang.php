<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanBarang extends Model
{
    use HasFactory;

    protected $table = 'penjualan_barang';

    protected $fillable = [
        'kode', 'nama', 'jumlah_terjual', 'harga_satuan', 'total', 'keuntungan',
    ];

    public function getTotal()
    {
        return $this->jumlah_terjual * $this->harga_satuan;
    }

    public function getKeuntungan()
    {
        return $this->getTotal() - ($this->jumlah_terjual * $this->harga_satuan * 0.2); // asumsikan 20% adalah biaya lainnya
    }
}
