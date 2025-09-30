@extends('layouts.app')

@section('title', 'Supplier - Toko Sembako Damai')

@section('content')
<a href="{{ route('supplier.create') }}" class="btn btn-primary mb-3">Tambah Supplier</a>
<a href="{{ route('printb') }}" class="btn btn-primary mb-3" style="float: right;"><i class="fa-solid fa-print"></i> Cetak</a>
<div class="card">
    <div class="card-header">
        Data Supplier
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>No. Hp</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->nama_supplier }}</td>
                    <td>{{ $supplier->alamat }}</td>
                    <td>{{ $supplier->telepon }}</td>
                    <td>
                        <a href="{{ route('supplier.edit', ['supplier' => $supplier->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('supplier.destroy', $supplier->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus supplier ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data supplier.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-2 text-muted">
    Showing {{ $suppliers->count() }} entries
</div>
@endsection