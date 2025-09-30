@extends('layouts.app')

@section('title', isset($konsumen) ? 'Edit Konsumen - Toko Sembako Damai' : 'Tambah Konsumen - Toko Sembako Damai')

@section('content')
<div class="card">
    <div class="card-header">
        {{ isset($konsumen) ? 'Edit Konsumen' : 'Tambah Konsumen' }}
    </div>
    <div class="card-body">
        <form action="{{ isset($konsumen) ? route('konsumen.update', $konsumen->id) : route('konsumen.store') }}" method="POST">
            @csrf
            @if(isset($konsumen))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="nama_konsumen" class="form-label">Nama Konsumen</label>
                <input type="text" class="form-control" id="nama_konsumen" name="nama_konsumen" value="{{ old('nama_konsumen', $konsumen->nama_konsumen ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $konsumen->alamat ?? '') }}</textarea>
            </div>
            <div class="mb-3">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ old('telepon', $konsumen->telepon ?? '') }}" required>
            </div>
            <button type="submit" class="btn btn-primary">{{ isset($konsumen) ? 'Update' : 'Simpan' }}</button>
<a href="{{ route('konsumen.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
