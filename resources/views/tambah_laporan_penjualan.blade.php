@extends('layouts.app')

@section('title', 'Tambah Laporan Penjualan - Toko Sembako Damai')

@section('content')
<div class="container-fluid px-4 py-4">
    <h5 class="mb-4 text-primary">Form Laporan Penjualan</h5>
    <div class="card p-4">
<form method="POST" action="{{ isset($laporan) ? route('laporan_penjualan.update', $laporan->id) : route('laporan_penjualan.store') }}">
            @csrf
            @if(isset($laporan))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="transaksi_id" class="form-label">Transaksi ID</label>
                <input type="text" class="form-control" id="transaksi_id" name="transaksi_id" value="{{ old('transaksi_id', $laporan->transaksi_id ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $laporan->tanggal ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="konsumen" class="form-label">Konsumen</label>
                <select class="form-select" id="konsumen" name="konsumen">
                    <option disabled {{ !isset($laporan) ? 'selected' : '' }}>Pilih Konsumen</option>
                    @foreach ($konsumens as $konsumen)
                        <option value="{{ $konsumen->id }}" {{ (isset($laporan) && $laporan->konsumen_id == $konsumen->id) ? 'selected' : '' }}>{{ $konsumen->nama_konsumen }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="produk" class="form-label">Produk</label>
                <input type="text" class="form-control" id="produk" name="produk" placeholder="Contoh: Minyak Bimoli, Beras Cap Tani" value="{{ old('produk', $laporan->produk ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total" name="total" value="{{ old('total', $laporan->total ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="keuntungan" class="form-label">Keuntungan</label>
                <input type="text" class="form-control" id="keuntungan" name="keuntungan" value="{{ old('keuntungan', $laporan->keuntungan ?? '') }}" />
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">{{ isset($laporan) ? 'Update' : 'Simpan' }}</button>
                <button type="button" class="btn btn-danger px-4" onclick="window.location.href='{{ route('laporan_penjualan.index') }}'">Batal</button>
            </div>
        </form>
    </div>
</div>
@endsection
