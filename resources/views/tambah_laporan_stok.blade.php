@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <h5 class="mb-4 text-primary">Form Laporan Stok Barang</h5>
    <div class="card p-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(isset($laporanStok))
            <form method="POST" action="{{ route('laporan_stok.update', $laporanStok->id) }}">
            @method('PUT')
        @else
            <form method="POST" action="{{ route('laporan_stok.store') }}">
        @endif
            @csrf
            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', isset($laporanStok) ? $laporanStok->kode : '') }}" />
                @error('kode')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', isset($laporanStok) ? $laporanStok->nama_produk : '') }}" />
                @error('nama_produk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="stok_awal" class="form-label">Stok Awal</label>
                <input type="number" class="form-control" id="stok_awal" name="stok_awal" value="{{ old('stok_awal', isset($laporanStok) ? $laporanStok->stok_awal : '') }}" />
                @error('stok_awal')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="barang_masuk" class="form-label">Barang Masuk</label>
                <input type="number" class="form-control" id="barang_masuk" name="barang_masuk" value="{{ old('barang_masuk', isset($laporanStok) ? $laporanStok->barang_masuk : '') }}" />
                @error('barang_masuk')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="barang_keluar" class="form-label">Barang Keluar</label>
                <input type="number" class="form-control" id="barang_keluar" name="barang_keluar" value="{{ old('barang_keluar', isset($laporanStok) ? $laporanStok->barang_keluar : '') }}" />
                @error('barang_keluar')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">{{ isset($laporanStok) ? 'Update' : 'Simpan' }}</button>
<a href="{{ route('laporan_stok.index') }}" class="btn btn-danger px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
