<?php

namespace App\Http\Controllers;

use App\Models\Konsumen;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    public function index()
    {
        $konsumens = Konsumen::all();
        return view('konsumen', compact('konsumens'));
    }

    public function create()
    {
        return view('tambah_konsumen');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        Konsumen::create($request->all());

        return redirect()->route('konsumen')->with('success', 'Konsumen berhasil ditambahkan.');
    }

    public function edit(Konsumen $konsumen)
    {
        return view('tambah_konsumen', compact('konsumen'));
    }

    public function update(Request $request, Konsumen $konsumen)
    {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);

        $konsumen->update($request->all());

        return redirect()->route('konsumen')->with('success', 'Konsumen berhasil diperbarui.');
    }

    public function destroy(Konsumen $konsumen)
    {
        $konsumen->delete();

        return redirect()->route('konsumen')->with('success', 'Konsumen berhasil dihapus.');
    }
}
