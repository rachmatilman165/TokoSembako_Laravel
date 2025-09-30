@extends('layouts.app')

@section('title', 'Produk - Toko Sembako Damai')

@section('content')
<a href="{{ route('produk.create') }}" class="btn btn-primary mb-3">Tambah Produk</a>
<a href="{{ route('printa') }}" class="btn btn-primary mb-3" style="float: right;"><i class="fa-solid fa-print"></i> Cetak</a>
<div class="card">
    <div class="card-header">
        Data Produk
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>id</th>
                    <!-- <th>Foto</th> -->
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produks as $produk)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <!-- <td><img src="{{ asset('storage/photo-user/'.$produk->gambar) }}" alt="" width="100"></td> -->
                    <td>{{ $produk->kode_produk }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ number_format($produk->harga, 2, ',', '.') }}</td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->supplier ? $produk->supplier->nama_supplier : '-' }}</td>
                    <td>
                        <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data produk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-2 text-muted">
    Showing {{ $produks->count() }} entries
</div>
@endsection