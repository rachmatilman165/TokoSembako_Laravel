@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <h5 class="mb-4 text-primary">Form Laporan Pengeluaran</h5>
    <div class="card p-4">
        @if(isset($laporan))
        <form action="{{ route('laporan_pengeluaran.update', $laporan->id) }}" method="POST">
            @method('PUT')
        @else
        <form action="{{ route('laporan_pengeluaran.store') }}" method="POST">
        @endif
            @csrf
            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', isset($laporan) ? $laporan->kode : '') }}" />
                @error('kode')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori', isset($laporan) ? $laporan->kategori : '') }}" />
                @error('kategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" class="form-control" id="total" name="total" value="{{ old('total', isset($laporan) ? $laporan->total : '') }}" />
                @error('total')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan" value="{{ old('keterangan', isset($laporan) ? $laporan->keterangan : '') }}" />
                @error('keterangan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="{{ route('laporan_keuangan.index') }}" class="btn btn-danger px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
