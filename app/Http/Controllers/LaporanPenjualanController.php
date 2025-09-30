<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualan;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\transaksi_pembelian;
use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    public function index()
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

        return view('laporan_penjualan', compact('transaksis', 'jumtrans', 'totalTransaksi', 'totalPendapatan', 'totalBarangTerjual', 'keuntunganBersih'));
    }

    public function filterTanggal(Request $request)
    {

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        // Calculate totals
        $totalTransaksi = \App\Models\Transaksi::count();
        $totalPendapatan = \App\Models\Transaksi::sum('sub_total');
        $totalBarangTerjual = \App\Models\Transaksi::sum('jumlah');


        $transaksis = Transaksi::with('produk')->whereBetween('tanggal', [$start_date, $end_date])->paginate(10); // Ganti 'tanggal_kolom' dengan nama kolom yang sesuai

        return view('laporan_penjualan', compact('transaksis', 'totalTransaksi', 'totalPendapatan', 'totalBarangTerjual'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'transaksi_id' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'konsumen' => 'required|exists:konsumens,id',
            'produk' => 'required|string|max:255',
            'total' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);

        LaporanPenjualan::create([
            'transaksi_id' => $request->transaksi_id,
            'tanggal' => $request->tanggal,
            'konsumen_id' => $request->konsumen,
            'produk' => $request->produk,
            'total' => $request->total,
            'keuntungan' => $request->keuntungan,
        ]);

        return redirect()->route('laporan_penjualan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);
        $konsumens = \App\Models\Konsumen::all();
        return view('tambah_laporan_penjualan', compact('laporan', 'konsumens'));
    }

    // public function uye(Request $request)
    // {
    //     $tasks = LaporanPenjualan::query();

    //     // Filter berdasarkan rentang tanggal
    //     if ($request->has(['start_date', 'end_date'])) {
    //         $start_date = $request->input('start_date');
    //         $end_date = $request->input('end_date');
    //         $tasks = $tasks->whereBetween('tanggal', [$start_date, $end_date]);
    //     }

    //     $laporanPenjualan = $tasks->get();

    //     return view('laporan_penjualan', compact('laporanPenjualan'));
    // }

    public function update(Request $request, $id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);

        $request->validate([
            'transaksi_id' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'konsumen' => 'required|exists:konsumens,id',
            'produk' => 'required|string|max:255',
            'total' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);

        $laporan->update($request->all());

        return redirect()->route('laporan_penjualan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = LaporanPenjualan::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan_penjualan.index')->with('success', 'Data berhasil dihapus.');
    }
}
