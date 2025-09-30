<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanPendapatanLain extends Model
{
    use HasFactory;

    protected $table = 'laporan_pendapatan_lain';

    protected $fillable = [
        'kode',
        'sumber_pendapatan',
        'harga',
        'keterangan',
    ];
}
