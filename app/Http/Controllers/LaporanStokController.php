<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanStok;

class LaporanStokController extends Controller
{
    public function index()
    {
        $laporanStoks = LaporanStok::all();
        return view('laporan_stok_barang', compact('laporanStoks'));
    }

    public function create()
    {
        return view('tambah_laporan_stok');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'stok_awal' => 'required|integer',
            'barang_masuk' => 'required|integer',
            'barang_keluar' => 'required|integer',
        ]);

        LaporanStok::create($validated);

        return redirect()->route('laporan_stok_barang')->with('success', 'Laporan stok berhasil disimpan.');
    }

    public function edit($id)
    {
        $laporanStok = LaporanStok::findOrFail($id);
        return view('tambah_laporan_stok', compact('laporanStok'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'stok_awal' => 'required|integer',
            'barang_masuk' => 'required|integer',
            'barang_keluar' => 'required|integer',
        ]);

        $laporanStok = LaporanStok::findOrFail($id);
        $laporanStok->update($validated);

        return redirect()->route('laporan_stok_barang')->with('success', 'Laporan stok berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporanStok = LaporanStok::findOrFail($id);
        $laporanStok->delete();

        return redirect()->route('laporan_stok_barang')->with('success', 'Laporan stok berhasil dihapus.');
    }
}
