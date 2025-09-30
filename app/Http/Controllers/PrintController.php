<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Supplier;
use App\Models\LaporanPenjualan;
use App\Models\LaporanPenjualanBarang;
use App\Models\LaporanPendapatanLain;
use App\Models\LaporanPengeluaran;
use App\Models\Transaksi;

class PrintController extends Controller
{
    public function printA()
    {
        $produks = Produk::all();
        return view('print.printProduk', compact('produks'));
    }

    public function printB()
    {
        $suppliers = Supplier::all();
        return view('print.printSupliers', compact('suppliers'));
    }

    public function printC()
    {
        $transaksis = Transaksi::with('produk')->get();
        $laporanPenjualan = LaporanPenjualanBarang::with('produk')->get();

        return view('print.printLaporanKeuangan', compact('laporanPenjualan', 'transaksis'));
    }

    public function printD()
    {
        $transaksis = Transaksi::with('produk')->get();
        // $produks = Produk::all();
        $jumtrans = Transaksi::all();
        // Calculate totals
        $totalTransaksi = \App\Models\Transaksi::count();
        $totalPendapatan = \App\Models\Transaksi::sum('sub_total');
        $totalBarangTerjual = \App\Models\Transaksi::sum('jumlah');
        $total_pembelian = \App\Models\transaksi_pembelian::sum('total');
        $keuntunganBersih = $totalPendapatan - $total_pembelian;

        return view('print.printLaporanPenjualan', compact('transaksis', 'jumtrans', 'totalTransaksi', 'totalPendapatan', 'totalBarangTerjual', 'keuntunganBersih'));
    }
}
