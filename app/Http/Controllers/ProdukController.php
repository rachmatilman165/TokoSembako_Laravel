<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('supplier')->get();
        return view('produk', compact('produks'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        return view('tambah_produk', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'url' => 'required',
            // 'gambar' => 'required|mimes:jpg,jpeg,png|max:2048',
            'supplier_id' => 'required',
        ]);

        // $photo = $request->file('gambar');
        // $filename = $request->nama_produk . Str::random(5) . "." . $photo->getClientOriginalExtension();
        // $path = 'photo-user/' . $filename;
        // Storage::disk('public')->put($path, file_get_contents($photo));

        $name['kode_produk'] = $request->kode_produk;
        $name['nama_produk'] = $request->nama_produk;
        $name['harga'] = $request->harga;
        $name['stok'] = $request->stok;
        $name['url'] = $request->url;
        // $name['gambar'] = $filename;
        $name['supplier_id'] = $request->supplier_id;

        Produk::create($name);

        return redirect()->route('produk.index')->with('success', 'Konsumen berhasil ditambahkan.');
    }

    public function edit(Produk $produk)
    {
        $suppliers = Supplier::all();
        return view('tambah_produk', compact('produk', 'suppliers'));
    }

    public function buat(Request $request)
    {
        return redirect()->route('produk.index')->with('success', 'Konsumen berhasil ditambahkan.');
    }

    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produk,kode_produk,' . $produk->id,
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        $produk->update([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('produk')->with('success', 'Data berhasil diupdate');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();

        return redirect()->route('produk')->with('success', 'Data berhasil dihapus');
    }
}
