@extends('layouts.app')

@section('title', 'Tambah Transaksi - Toko Sembako Damai')

@section('content')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<div class="container-fluid px-4 py-4">
    <h5 class="mb-4 text-primary">Form Tambah Transaksi Pembelian</h5>
    <div class="card p-4">
        <form method="POST" enctype="multipart/form-data" action="{{ route('transaksi_pembelian.store') }}">
            @csrf
            <!-- <div class="mb-3">
                <label for="id" class="form-label">Transaksi_id</label>
                <input type="text" class="form-control" id="transaksi_id" name="transaksi_id" />
            </div> -->
            <!-- <div class="mb-3">
                <label for="id" class="form-label">Produk_id</label>
                <input type="text" class="form-control" id="produk_id" name="produk_id" />
            </div> -->
            <div class="mb-3">
                <label for="supplier_id" class="form-label">Produk</label>
                <select class="form-select" id="produk_id" name="produk_id">
                    <option value="">-- Pilih Produk --</option>
                    @foreach($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" />
            </div>
            <div class="mb-3">
                <label for="id" class="form-label">Harga</label>
                <input type="number" class="form-control" id="total" name="total" />
            </div>
            <!-- <div class="mb-3">
                <label for="id" class="form-label">Subtotal</label>
                <input type="number" class="form-control" id="subtotal" name="subtotal" />
            </div> -->
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">Simpan</button>
                <a href="{{ route('transaksi_pembelian.index') }}" class="btn btn-danger px-4">Batal</a>
            </div>
        </form>
        <!-- <script>
            $(document).ready(function() {
                $('#produk_id').change(function() {
                    var barang_id = $(this).val();
                    if (barang_id) {
                        $.ajax({
                            url: '/get-harga/' + barang_id, // Ganti dengan URL route yang sesuai
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('#total').val(data.harga);
                            }
                        });
                    } else {
                        $('#total').val('');
                    }
                });
            });
        </script> -->
    </div>
</div>
@endsection