<?php

namespace App\Http\Controllers;

use App\Models\transaksi_pembelian;
use App\Models\Produk;
use App\Models\LaporanStok;

use Illuminate\Http\Request;

class TransaksiPembelianController extends Controller
{
    public function index()
    {
        $transaksis = transaksi_pembelian::with('produk')->get();
        $produks = Produk::all();
        $jumtrans = transaksi_pembelian::all();
        return view('transaksi_pembelian', compact('transaksis', 'produks', 'jumtrans'));
    }

    public function store(Request $request)
    {
        $produkk = Produk::where('id', $request->produk_id)->first();
        $request->validate([
            // 'transaksi_id' => 'required',
            'produk_id' => 'required',
            'jumlah' => 'required',
            'total' => 'required',
        ]);

        $subtotal = $request->jumlah * $request->total;

        $name['produk_id'] = $request->produk_id;
        $name['jumlah'] = $request->jumlah;
        $name['harga'] = $request->total;
        $name['total'] = $subtotal;

        transaksi_pembelian::create($name);

        $pro_deks = Produk::where('id', $request->produk_id)->first();
        $stok_awal = $pro_deks->stok;
        $stok_akhir = $stok_awal + $request->jumlah;
        // tabel laporan stoks//
        $data['kode'] = $pro_deks->kode_produk;
        $data['nama_produk'] = $pro_deks->nama_produk;
        $data['stok_awal'] = $stok_awal;
        $data['barang_masuk'] = $request->jumlah;
        $data['barang_keluar'] = 0;
        $data['stok_akhir'] = $stok_akhir;

        LaporanStok::create($data);

        $produkk->increment('stok', $request->jumlah);

        return redirect()->route('transaksi_pembelian.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function destroy($pid)
    {
        $produkk = Produk::where('id', $pid)->first();
        $transaksi_pilih = transaksi_pembelian::where('produk_id', $pid)->first();
        $transaksi_pilih->delete();
        $produkk->decrement('stok', $transaksi_pilih->jumlah);
        return redirect()->route('transaksi_pembelian.index')->with('success', 'Produk berhasil dihapus.');
    }
}
