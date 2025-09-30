<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPenjualanBarang;
use App\Models\LaporanPendapatanLain;
use App\Models\LaporanPengeluaran;
use App\Models\Transaksi;

class LaporanKeuanganController extends Controller
{
    public function index()
    {

        $transaksis = Transaksi::with('produk')->get();
        $laporanPenjualan = LaporanPenjualanBarang::with('produk')->get();
        $laporanPenjualanBarang = LaporanPenjualanBarang::all();
        $laporanPendapatanLain = LaporanPendapatanLain::all();
        $laporanPengeluaran = LaporanPengeluaran::all();

        return view('laporan_keuangan', compact('laporanPenjualan', 'transaksis', 'laporanPenjualanBarang', 'laporanPendapatanLain', 'laporanPengeluaran'));
    }
}
