@extends('layouts.app')

@section('title', 'Tambah Produk - Toko Sembako Damai')

@section('content')
<div class="container-fluid px-4 py-4">
    <h5 class="mb-4 text-primary">Form Tambah Produk</h5>
    <div class="card p-4">
        <form method="POST" enctype="multipart/form-data" action="{{ isset($produk) ? route('produk.update', ['produk' => $produk->id]) : route('produk.store') }}">
            @csrf
            @if(isset($produk))
            @method('PUT')
            @endif
            <div class="mb-3">
                <label for="id" class="form-label">id</label>
                <input type="text" class="form-control" id="id" name="id" readonly value="{{ old('id', $produk->id ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="kode_produk" class="form-label">Kode Produk</label>
                <input type="text" class="form-control" id="kode_produk" name="kode_produk" required value="{{ old('kode_produk', $produk->kode_produk ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="nama_produk" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama_produk" name="nama_produk" required value="{{ old('nama_produk', $produk->nama_produk ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" required value="{{ old('harga', $produk->harga ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok" required value="{{ old('stok', $produk->stok ?? '') }}" />
            </div>
            <div class="mb-3">
                <label for="link" class="form-label">link</label>
                <input type="text" class="form-control" id="url" name="url" required value="{{ old('url', $produk->url ?? '') }}" />
            </div>
            <!-- <div class="mb-3">
                <label for="formFile" class="form-label">Foto</label>
                <input class="form-control" type="file" id="gambar" name="gambar">
            </div> -->
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Supplier</label>
                <select class="form-select" id="supplier_id" name="supplier_id">
                    <option value="">-- Pilih Supplier --</option>
                    @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ (old('supplier_id', $produk->supplier_id ?? '') == $supplier->id) ? 'selected' : '' }}>{{ $supplier->nama_supplier }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="{{ route('produk.index') }}" class="btn btn-danger px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection