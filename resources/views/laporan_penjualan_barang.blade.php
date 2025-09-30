@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <h1>Laporan Penjualan Barang</h1>
    <a href="{{ route('laporan_penjualan_barang.create') }}" class="btn btn-primary mb-3">Tambah Laporan</a>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah Terjual</th>
                <th>Harga Satuan</th>
                <th>Total</th>
                <th>Keuntungan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporan as $item)
            <tr>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->jumlah_terjual }}</td>
                <td>Rp. {{ number_format($item->harga_satuan, 2) }}</td>
                <td>Rp. {{ number_format($item->total, 2) }}</td>
                <td>Rp. {{ number_format($item->keuntungan, 2) }}</td>
                <td>Rp. {{ number_format($item->keuntungan, 2) }}</td>
                <td>
                    <a href="{{ route('laporan_penjualan_barang.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('laporan_penjualan_barang.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection