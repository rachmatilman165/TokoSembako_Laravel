@extends('layouts.app')

@section('title', 'Laporan Penjualan - Toko Sembako Damai')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- <a class="btn btn-primary mb-3" href="{{ route('tambah_laporan_penjualan') }}">Tambah Laporan</a> -->
    <form action="{{ route('laporan_penjualan.filter') }}">
        <label for="start_date">Tanggal Mulai:</label>
        <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

        <label for="end_date">Tanggal Akhir:</label>
        <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">

        <button type="submit" class="btn btn-primary mb-3">Filter</button>
        <a href="{{ route('printd') }}" class="btn btn-primary mb-3" style="float: right;"><i class="fa-solid fa-print"></i> Cetak</a>
    </form>
    <div class="card mb-3">
        <div class="card-header">
            Penjualan
        </div>
        <div class="card-body">
            <form class="row g-3 align-items-center">
                <!-- <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="printStockReportBtn">Cetak</button>
                </div> -->

                <div class="row g-3 mb-3">
                    <div class="col-md-6 col-lg-3">
                        <div class="card text-white" style="background-color: #6c7ae0;">
                            <div class="card-body">
                                <h6 class="card-title text-center">Total Transaksi</h6>
                                <p class="card-text text-center fs-4">{{ $totalTransaksi ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card text-white" style="background-color: #9aa9e7;">
                            <div class="card-body">
                                <h6 class="card-title text-center">Total Pendapatan</h6>
                                <p class="card-text text-center fs-4">{{ $totalPendapatan ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card text-white" style="background-color: #1e3a8a;">
                            <div class="card-body">
                                <h6 class="card-title text-center">Total Barang Terjual</h6>
                                <p class="card-text text-center fs-4">{{ $totalBarangTerjual ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card text-white" style="background-color: #1e40af;">
                            <div class="card-body">
                                <h6 class="card-title text-center">Keuntungan Bersih</h6>
                                <p class="card-text text-center fs-4">{{ $keuntunganBersih ?? 0 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Data Laporan Penjualan</span>
                        <div class="d-flex align-items-center">
                            <form method="GET" action="{{ route('laporan_penjualan.index') }}" class="d-flex">
                                <input type="search" name="search" class="form-control form-control-sm" placeholder="Cari Transaksi...." value="{{ request('search') }}" aria-label="Search" />
                                <button type="submit" class="btn btn-light btn-sm ms-2"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <!-- <th>Transaksi ID</th> -->
                                    <th>Tanggal</th>
                                    <!-- <th>Konsumen</th> -->
                                    <!-- <th>Produk id</th> -->
                                    <th>Nama Produk</th>
                                    <th>Total</th>
                                    <!-- <th>Keuntungan</th> -->
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksis as $laporan)
                                <tr>
                                    <!-- <td>{{ $laporan->transaksi_id }}</td> -->
                                    <td>{{ date('d-m-Y', strtotime($laporan->tanggal)) }}</td>
                                    <!-- <td>{{ $laporan->konsumen->nama_konsumen ?? 'N/A' }}</td> -->
                                    <!-- <td>{{ $laporan->produk_id }}</td> -->
                                    <td>{{ $laporan->produk ? $laporan->produk->nama_produk : '-' }}</td>
                                    <td>{{ $laporan->sub_total }}</td>
                                    <!-- <td>{{ $laporan->keuntungan }}</td> -->
                                    <td>
                                        <form action="{{ route('transaksi.destroy', $laporan->produk_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data laporan penjualan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
        </div>
        @endsection