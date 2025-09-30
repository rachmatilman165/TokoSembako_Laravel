<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\LaporanStokController;
use App\Http\Controllers\LaporanPenjualanBarangController;
use App\Http\Controllers\LaporanPendapatanLainController;
use App\Http\Controllers\AutoPriceController;
use App\Http\Controllers\LaporanPengeluaranController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiPembelianController;
use App\Models\Konsumen;
use App\Models\Produk;
use App\Http\Controllers\PrintController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $produkCount = \App\Models\Produk::count();
        $supplierCount = \App\Models\Supplier::count();
        $konsumenCount = \App\Models\Konsumen::count();
        $transaksiCount = \App\Models\Transaksi::count();
        return view('dashboard', compact('produkCount', 'supplierCount', 'konsumenCount', 'transaksiCount'));
    })->name('dashboard');

    Route::get('/PrintA', [PrintController::class, 'printA'])->name('printa');
    Route::get('/PrintB', [PrintController::class, 'printB'])->name('printb');
    Route::get('/PrintC', [PrintController::class, 'printC'])->name('printc');
    Route::get('/PrintD', [PrintController::class, 'printD'])->name('printd');

    Route::get('/laporan_penjualan', [LaporanPenjualanController::class, 'index'])->name('laporan_penjualan.index');
    Route::get('/laporan_penjualan/filter', [LaporanPenjualanController::class, 'filterTanggal'])->name('laporan_penjualan.filter');

    Route::post('/laporan_penjualan', [LaporanPenjualanController::class, 'store'])->name('laporan_penjualan.store');

    Route::get('/tambah_laporan_penjualan', function () {
        $konsumens = Konsumen::all();
        return view('tambah_laporan_penjualan', compact('konsumens'));
    })->name('tambah_laporan_penjualan');

    Route::get('/laporan_penjualan/{laporan_penjualan}/edit', function ($laporanPenjualanId) {
        $laporan = \App\Models\LaporanPenjualan::findOrFail($laporanPenjualanId);
        $konsumens = \App\Models\Konsumen::all();
        return view('tambah_laporan_penjualan', compact('laporan', 'konsumens'));
    })->name('laporan_penjualan.edit');

    Route::put('/laporan_penjualan/{laporan_penjualan}', function (\Illuminate\Http\Request $request, $laporanPenjualanId) {
        $laporan = \App\Models\LaporanPenjualan::findOrFail($laporanPenjualanId);
        $request->validate([
            'transaksi_id' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'konsumen' => 'required|exists:konsumens,id',
            'produk' => 'required|string|max:255',
            'total' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);
        $laporan->update([
            'transaksi_id' => $request->transaksi_id,
            'tanggal' => $request->tanggal,
            'konsumen_id' => $request->konsumen,
            'produk' => $request->produk,
            'total' => $request->total,
            'keuntungan' => $request->keuntungan,
        ]);
        return redirect()->route('laporan_penjualan.index')->with('success', 'Data berhasil diperbarui.');
    })->name('laporan_penjualan.update');

    Route::delete('/laporan_penjualan/{laporan_penjualan}', function ($laporanPenjualanId) {
        $laporan = \App\Models\LaporanPenjualan::findOrFail($laporanPenjualanId);
        $laporan->delete();
        return redirect()->route('laporan_penjualan.index')->with('success', 'Data berhasil dihapus.');
    })->name('laporan_penjualan.destroy');

    // Other routes...

    Route::get('/produk', function () {
        $produks = \App\Models\Produk::all();
        return view('produk', compact('produks'));
    })->name('produk.index');

    Route::get('/produk/create', function () {
        $suppliers = \App\Models\Supplier::all();
        return view('tambah_produk', compact('suppliers'));
    })->name('produk.create');

    Route::post(
        '/produk',
        [ProdukController::class, 'store']
        // function (\Illuminate\Http\Request $request) {
        //     // $request->file('gambar')->store('post-images');
        //     $request->validate([
        //         'nama_produk' => 'required|string|max:255',
        //         'harga' => 'required|numeric',
        //         'stok' => 'required|integer',
        //     ]);
        //     \App\Models\Produk::create($request->all());
        //     return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');}
    )->name('produk.store');

    Route::get('/produk/{produk}/edit', function ($produkId) {
        $produk = \App\Models\Produk::findOrFail($produkId);
        $suppliers = \App\Models\Supplier::all();
        return view('tambah_produk', compact('produk', 'suppliers'));
    })->name('produk.edit');

    Route::put('/produk/{produk}', function (\Illuminate\Http\Request $request, $produkId) {
        $produk = \App\Models\Produk::findOrFail($produkId);
        $min = $produk->stok;
        $min = $min + 1;
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'stok' => 'required|integer|min:' . $min,
        ]);
        $produk->update($request->all());
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    })->name('produk.update');

    Route::delete('/produk/{produk}', function ($produkId) {
        $produk = \App\Models\Produk::findOrFail($produkId);
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    })->name('produk.destroy');
    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/supplier/{supplier}/edit', function ($supplierId) {
        $supplier = \App\Models\Supplier::findOrFail($supplierId);
        $suppliers = \App\Models\Supplier::all();
        return view('tambah_supplier', compact('supplier', 'suppliers'));
    })->name('supplier.edit');
    Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
    Route::get('/konsumen', [KonsumenController::class, 'index'])->name('konsumen.index');

    Route::get('/konsumen/create', function () {
        return view('tambah_konsumen');
    })->name('konsumen.create');

    Route::post('/konsumen', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);
        \App\Models\Konsumen::create($request->all());
        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil ditambahkan.');
    })->name('konsumen.store');

    Route::get('/konsumen/{konsumen}/edit', function ($konsumenId) {
        $konsumen = \App\Models\Konsumen::findOrFail($konsumenId);
        return view('tambah_konsumen', compact('konsumen'));
    })->name('konsumen.edit');

    Route::put('/konsumen/{konsumen}', function (\Illuminate\Http\Request $request, $konsumenId) {
        $konsumen = \App\Models\Konsumen::findOrFail($konsumenId);
        $request->validate([
            'nama_konsumen' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
        ]);
        $konsumen->update($request->all());
        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil diperbarui.');
    })->name('konsumen.update');

    Route::delete('/konsumen/{konsumen}', function ($konsumenId) {
        $konsumen = \App\Models\Konsumen::findOrFail($konsumenId);
        $konsumen->delete();
        return redirect()->route('konsumen.index')->with('success', 'Konsumen berhasil dihapus.');
    })->name('konsumen.destroy');
    Route::get('/laporan_stok_barang', [LaporanStokController::class, 'index'])->name('laporan_stok.index');

    Route::get('/laporan_stok/create', function () {
        return view('tambah_laporan_stok');
    })->name('laporan_stok.create');

    Route::post('/laporan_stok', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'stok_awal' => 'required|integer',
            'barang_masuk' => 'required|integer',
            'barang_keluar' => 'required|integer',
        ]);
        \App\Models\LaporanStok::create($request->all());
        return redirect()->route('laporan_stok.index')->with('success', 'Laporan stok berhasil disimpan.');
    })->name('laporan_stok.store');

    Route::get('/laporan_stok/{laporan_stok}/edit', function ($laporanStokId) {
        $laporanStok = \App\Models\LaporanStok::findOrFail($laporanStokId);
        return view('tambah_laporan_stok', compact('laporanStok'));
    })->name('laporan_stok.edit');

    Route::put('/laporan_stok/{laporan_stok}', function (\Illuminate\Http\Request $request, $laporanStokId) {
        $laporanStok = \App\Models\LaporanStok::findOrFail($laporanStokId);
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama_produk' => 'required|string|max:255',
            'stok_awal' => 'required|integer',
            'barang_masuk' => 'required|integer',
            'barang_keluar' => 'required|integer',
        ]);
        $laporanStok->update($request->all());
        return redirect()->route('laporan_stok.index')->with('success', 'Laporan stok berhasil diperbarui.');
    })->name('laporan_stok.update');

    Route::delete('/laporan_stok/{laporan_stok}', function ($laporanStokId) {
        $laporanStok = \App\Models\LaporanStok::findOrFail($laporanStokId);
        $laporanStok->delete();
        return redirect()->route('laporan_stok.index')->with('success', 'Laporan stok berhasil dihapus.');
    })->name('laporan_stok.destroy');
    Route::get('/laporan_keuangan', [LaporanKeuanganController::class, 'index'])->name('laporan_keuangan.index');
    Route::get('/laporan_pendapatan_lain', [LaporanPendapatanLainController::class, 'index'])->name('laporan_pendapatan_lain');

    Route::get('/laporan_pendapatan_lain/create', function () {
        return view('tambah_laporan_pendapatan_lain');
    })->name('laporan_pendapatan_lain.create');

    Route::post('/laporan_pendapatan_lain', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'kode' => 'required|string|max:255',
            'sumber_pendapatan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);
        \App\Models\LaporanPendapatanLain::create($request->all());
        return redirect()->route('laporan_keuangan.index')->with('success', 'Data berhasil disimpan');
    })->name('laporan_pendapatan_lain.store');

    Route::get('/laporan_pendapatan_lain/{laporan_pendapatan_lain}/edit', function ($laporanPendapatanLainId) {
        $laporan = \App\Models\LaporanPendapatanLain::findOrFail($laporanPendapatanLainId);
        return view('tambah_laporan_pendapatan_lain', compact('laporan'));
    })->name('laporan_pendapatan_lain.edit');

    Route::put('/laporan_pendapatan_lain/{laporan_pendapatan_lain}', function (\Illuminate\Http\Request $request, $laporanPendapatanLainId) {
        $laporan = \App\Models\LaporanPendapatanLain::findOrFail($laporanPendapatanLainId);
        $request->validate([
            'kode' => 'required|string|max:255',
            'sumber_pendapatan' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);
        $laporan->update($request->all());
        return redirect()->route('laporan_keuangan.index')->with('success', 'Data berhasil diperbarui');
    })->name('laporan_pendapatan_lain.update');

    Route::delete('/laporan_pendapatan_lain/{laporan_pendapatan_lain}', function ($laporanPendapatanLainId) {
        $laporan = \App\Models\LaporanPendapatanLain::findOrFail($laporanPendapatanLainId);
        $laporan->delete();
        return redirect()->route('laporan_keuangan.index')->with('success', 'Data berhasil dihapus');
    })->name('laporan_pendapatan_lain.destroy');

    Route::get('/laporan_pengeluaran/create', function () {
        return view('tambah_laporan_pengeluaran');
    })->name('laporan_pengeluaran.create');

    Route::post('/laporan_pengeluaran', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'kode' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);
        \App\Models\LaporanPengeluaran::create($request->all());
        return redirect()->route('laporan_keuangan.index')->with('success', 'Data berhasil disimpan');
    })->name('laporan_pengeluaran.store');

    Route::get('/laporan_pengeluaran/{laporan_pengeluaran}/edit', function ($laporanPengeluaranId) {
        $laporan = \App\Models\LaporanPengeluaran::findOrFail($laporanPengeluaranId);
        return view('tambah_laporan_pengeluaran', compact('laporan'));
    })->name('laporan_pengeluaran.edit');

    Route::put('/laporan_pengeluaran/{laporan_pengeluaran}', function (\Illuminate\Http\Request $request, $laporanPengeluaranId) {
        $laporan = \App\Models\LaporanPengeluaran::findOrFail($laporanPengeluaranId);
        $request->validate([
            'kode' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'total' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);
        $laporan->update($request->all());
        return redirect()->route('laporan_keuangan.index')->with('success', 'Data berhasil diperbarui');
    })->name('laporan_pengeluaran.update');

    Route::delete('/laporan_pengeluaran/{laporan_pengeluaran}', function ($laporanPengeluaranId) {
        $laporan = \App\Models\LaporanPengeluaran::findOrFail($laporanPengeluaranId);
        $laporan->delete();
        return redirect()->route('laporan_keuangan.index')->with('success', 'Data berhasil dihapus');
    })->name('laporan_pengeluaran.destroy');

    Route::get('/laporan_penjualan_barang', [LaporanPenjualanBarangController::class, 'index'])->name('laporan_penjualan_barang');

    Route::get('/laporan_penjualan_barang/create', function () {
        return view('tambah_laporan_penjualan_barang');
    })->name('laporan_penjualan_barang.create');

    Route::post('/laporan_penjualan_barang', function (\Illuminate\Http\Request $request) {
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jumlah_terjual' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'total' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);
        \App\Models\LaporanPenjualanBarang::create($request->all());
        return redirect()->route('laporan_keuangan.index')->with('success', 'Laporan penjualan barang berhasil ditambahkan.');
    })->name('laporan_penjualan_barang.store');

    Route::get('/laporan_penjualan_barang/{laporan_penjualan_barang}/edit', function ($laporanPenjualanBarangId) {
        $laporan = \App\Models\LaporanPenjualanBarang::findOrFail($laporanPenjualanBarangId);
        return view('tambah_laporan_penjualan_barang', compact('laporan'));
    })->name('laporan_penjualan_barang.edit');

    Route::put('/laporan_penjualan_barang/{laporan_penjualan_barang}', function (\Illuminate\Http\Request $request, $laporanPenjualanBarangId) {
        $laporan = \App\Models\LaporanPenjualanBarang::findOrFail($laporanPenjualanBarangId);
        $request->validate([
            'kode' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'jumlah_terjual' => 'required|integer',
            'harga_satuan' => 'required|numeric',
            'total' => 'required|numeric',
            'keuntungan' => 'required|numeric',
        ]);
        $laporan->update($request->all());
        return redirect()->route('laporan_keuangan.index')->with('success', 'Laporan penjualan barang berhasil diperbarui.');
    })->name('laporan_penjualan_barang.update');

    Route::delete('/laporan_penjualan_barang/{laporan_penjualan_barang}', function ($laporanPenjualanBarangId) {
        $laporan = \App\Models\LaporanPenjualanBarang::findOrFail($laporanPenjualanBarangId);
        $laporan->delete();
        return redirect()->route('laporan_keuangan.index')->with('success', 'Laporan penjualan barang berhasil dihapus.');
    })->name('laporan_penjualan_barang.destroy');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi_pembelian', [TransaksiPembelianController::class, 'index'])->name('transaksi_pembelian.index');
    Route::get('/transaksi/create', function () {
        $produks = \App\Models\Produk::all();
        return view('tambah_transaksi', compact('produks'));
    })->name('transaksi.create');
    Route::get('/transaksi_pembelian/create', function () {
        $produks = \App\Models\Produk::all();
        return view('tambah_transaksi_pembelian', compact('produks'));
    })->name('transaksi_pembelian.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/transaksi_pembelian', [TransaksiPembelianController::class, 'store'])->name('transaksi_pembelian.store');
    Route::get('/get-harga/{id}', [AutoPriceController::class, 'getHarga']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::delete('/transaksi_pembelian/{id}', [TransaksiPembelianController::class, 'destroy'])->name('transaksi_pembelian.destroy');
});
