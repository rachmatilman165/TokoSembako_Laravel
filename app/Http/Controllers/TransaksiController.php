<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\LaporanPenjualan;
use App\Models\LaporanStok;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('produk')->get();
        // $produks = Produk::all();
        $jumtrans = Transaksi::all();
        return view('transaksi', compact('transaksis', 'jumtrans'));
    }

    public function update(Request $request, $nama_produk)
    {

        $name['nama_produk'] = $request->nama_produk;
        Produk::create($name);
    }

    public function store(Request $request)
    {
        $produkk = Produk::where('id', $request->produk_id)->first();
        $request->validate([
            // 'transaksi_id' => 'required',
            'produk_id' => 'required',
            'jumlah' => 'required',
            'total' => 'required',
            'tanggal' => 'required',
        ]);

        $subtotal = $request->jumlah * $request->total;

        $name['transaksi_id'] = Str::random(5);
        $name['produk_id'] = $request->produk_id;
        $name['tanggal'] = $request->tanggal;
        $name['jumlah'] = $request->jumlah;
        $name['total'] = $request->total;
        $name['sub_total'] = $subtotal;

        Transaksi::create($name);

        $pro_deks = Produk::where('id', $request->produk_id)->first();
        $stok_awal = $pro_deks->stok;
        $stok_akhir = $stok_awal - $request->jumlah;
        // tabel laporan stoks//
        $data['kode'] = $pro_deks->kode_produk;
        $data['nama_produk'] = $pro_deks->nama_produk;
        $data['stok_awal'] = $stok_awal;
        $data['barang_masuk'] = 0;
        $data['barang_keluar'] = $request->jumlah;
        $data['stok_akhir'] = $stok_akhir;

        LaporanStok::create($data);

        $produkk->decrement('stok', $request->jumlah);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil disimpan.');
    }
    public function destroy($pid)
    {
        $produkk = Produk::where('id', $pid)->first();
        $transaksi_pilih = Transaksi::where('produk_id', $pid)->first();
        $transaksi_pilih->delete();
        $produkk->increment('stok', $transaksi_pilih->jumlah);
        return redirect()->route('dashboard')->with('success', 'Produk berhasil dihapus.');
    }
}
