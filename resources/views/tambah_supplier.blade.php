@extends('layouts.app')

@section('title', isset($supplier) ? 'Edit Supplier - Toko Sembako Damai' : 'Tambah Supplier - Toko Sembako Damai')

@section('content')
<div class="card">
    <div class="card-header">
        {{ isset($supplier) ? 'Edit Supplier' : 'Tambah Supplier' }}
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ isset($supplier) ? route('supplier.update', ['supplier' => $supplier->id]) : route('supplier.store') }}" method="POST">
            @csrf
            @if(isset($supplier))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="nama_supplier" class="form-label">Nama Supplier</label>
                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier', $supplier->nama_supplier ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $supplier->alamat ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $supplier->telepon ?? '') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($supplier) ? 'Update' : 'Simpan' }}</button>
<a href="{{ route('supplier.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
