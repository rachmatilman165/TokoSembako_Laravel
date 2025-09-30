<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanPendapatanLain;

class LaporanPendapatanLainController extends Controller
{
    public function index()
    {
        $laporan = LaporanPendapatanLain::all();
        return view('laporan_pendapatan_lain', compact('laporan'));
    }

    public function create()
    {
        return view('tambah_laporan_pendapatan_lain');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:255',
            'sumber_pendapatan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        LaporanPendapatanLain::create($validated);

        return redirect()->route('laporan_keuangan')->with('success', 'Data berhasil disimpan');
    }

    public function edit($id)
    {
        $laporan = LaporanPendapatanLain::findOrFail($id);
        return view('tambah_laporan_pendapatan_lain', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        $laporan = LaporanPendapatanLain::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:255',
            'sumber_pendapatan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $laporan->update($validated);

        return redirect()->route('laporan_keuangan')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $laporan = LaporanPendapatanLain::findOrFail($id);
        $laporan->delete();

        return redirect()->route('laporan_keuangan')->with('success', 'Data berhasil dihapus');
    }
}
