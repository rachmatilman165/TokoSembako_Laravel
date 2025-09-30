<?php

namespace App\Http\Controllers;

use App\Models\LaporanPenjualanBarang;
use Illuminate\Http\Request;

class LaporanPenjualanBarangController extends Controller
{
    public function index()
    {
        $laporan = LaporanPenjualanBarang::all();
        return view('laporan_penjualan_barang', compact('laporan'));
    }

    public function create()
    {
        return view('tambah_laporan_penjualan_barang');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jumlah_terjual' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'total' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);

        LaporanPenjualanBarang::create($validated);

        return redirect()->route('laporan_keuangan')->with('success', 'Laporan penjualan barang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laporan = LaporanPenjualanBarang::findOrFail($id);
        return view('tambah_laporan_penjualan_barang', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanPenjualanBarang::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jumlah_terjual' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'total' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);

        $laporan->update($validated);

        return redirect()->route('laporan_keuangan')->with('success', 'Laporan penjualan barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = LaporanPenjualanBarang::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan_keuangan')->with('success', 'Laporan penjualan barang berhasil dihapus.');
    }
}
