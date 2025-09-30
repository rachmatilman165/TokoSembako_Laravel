<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPengeluaran;

class LaporanPengeluaranController extends Controller
{
    public function create()
    {
        return view('tambah_laporan_pengeluaran');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        LaporanPengeluaran::create([
            'kode' => $request->kode,
            'kategori' => $request->kategori,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('laporan_keuangan')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $laporan = LaporanPengeluaran::findOrFail($id);
        return view('tambah_laporan_pengeluaran', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanPengeluaran::findOrFail($id);

        $request->validate([
            'kode' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $laporan->update([
            'kode' => $request->kode,
            'kategori' => $request->kategori,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('laporan_keuangan')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = LaporanPengeluaran::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan_keuangan')->with('success', 'Data berhasil dihapus');
    }
}
