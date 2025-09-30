@extends('layouts.app')

@section('title', 'Transaksi - Toko Sembako Damai')

@section('content')
<a href="{{ route('transaksi_pembelian.create') }}" class="btn btn-primary mb-3">Tambah Pembelian</a>
<div class="card">
    <div class="card-header">
        Data Transaksi
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk_id</th>
                    <th>Nama_produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $trans)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $trans->produk_id }}</td>
                    <td>{{ $trans->produk ? $trans->produk->nama_produk : '-' }}</td>
                    <!-- <td>{{ number_format($trans->harga, 2, ',', '.') }}</td> -->
                    <td>{{ $trans->jumlah }}</td>
                    <td>{{ $trans->harga }}</td>
                    <td>{{ $trans->total }}</td>
                    <!-- <td>{{ $trans->supplier ? $trans->supplier->nama_supplier : '-' }}</td> -->
                    <td>
                        <form action="{{ route('transaksi_pembelian.destroy', $trans->produk_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi pembelian ini?')">Hapus</button>
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
    Showing {{ $jumtrans->count() }} entries
</div>
@endsection