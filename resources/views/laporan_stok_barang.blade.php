@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- <div class="card mb-3">
        <div class="card-header">
            Laporan Stok Barang
        </div>
        <div class="card-body">
            <form class="row g-3 align-items-center">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="printStockReportBtn">Cetak</button>
                </div>
            </form>

        </div>
    </div> -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Data Laporan Stok Barang</span>
            <div class="d-flex align-items-center">
                <input type="search" class="form-control form-control-sm" placeholder="Cari Stok Barang...." aria-label="Search" />
                <button class="btn btn-light btn-sm ms-2"><i class="fas fa-search"></i></button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Stok Awal</th>
                        <th>Barang Masuk</th>
                        <th>Barang Keluar</th>
                        <th>Stok Akhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanStoks as $laporan)
                    <tr>
                        <td>{{ $laporan->kode }}</td>
                        <td>{{ $laporan->nama_produk }}</td>
                        <td>{{ $laporan->stok_awal }}</td>
                        <td>{{ $laporan->barang_masuk }}</td>
                        <td>{{ $laporan->barang_keluar }}</td>
                        <td>{{ $laporan->stok_akhir }}</td>
                        <td>
                            <form action="{{ route('laporan_stok.destroy', $laporan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data laporan stok.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <div class="small text-muted">Showing {{ $laporanStoks->count() }} entries</div>
        </div>
    </div>
</div>
@endsection