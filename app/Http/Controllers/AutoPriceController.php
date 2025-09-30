<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class AutoPriceController extends Controller
{
    public function getHarga($id)
    {
        $barang = Produk::find($id);
        return response()->json(['harga' => $barang->harga]);
    }
}
