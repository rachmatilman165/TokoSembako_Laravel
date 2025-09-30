@extends('layouts.app')

@section('title', 'Konsumen - Toko Sembako Damai')

@section('content')
<a href="{{ route('konsumen.create') }}" class="btn btn-primary mb-3">Tambah Konsumen</a>
<div class="card">
    <div class="card-header">
        Data Konsumen
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nama Konsumen</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($konsumens as $konsumen)
                <tr>
                    <td>{{ $konsumen->id }}</td>
                    <td>{{ $konsumen->nama_konsumen }}</td>
                    <td>{{ $konsumen->alamat }}</td>
                    <td>{{ $konsumen->telepon }}</td>
                    <td>
                        <a href="{{ route('konsumen.edit', $konsumen->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('konsumen.destroy', $konsumen->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus konsumen ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data konsumen.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-2 text-muted">
    Showing {{ $konsumens->count() }} entries
</div>
@endsection
