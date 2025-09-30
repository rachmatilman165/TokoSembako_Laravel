<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanLain extends Model
{
    use HasFactory;

    protected $table = 'pendapatan_lain';

    protected $fillable = [
        'kode', 'sumber_pendapatan', 'harga', 'keterangan',
    ];
}
