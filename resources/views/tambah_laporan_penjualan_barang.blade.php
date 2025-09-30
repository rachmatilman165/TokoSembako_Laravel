@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h5 class="mb-4 text-primary">Form Tambah Laporan Penjualan Barang</h5>
    <div class="card p-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($laporan) ? route('laporan_penjualan_barang.update', $laporan->id) : route('laporan_penjualan_barang.store') }}" method="POST" id="laporanForm">
            @csrf
            @if(isset($laporan))
                @method('PUT')
            @endif
            <div class="mb-3">
                <label for="kode" class="form-label">Kode</label>
                <input type="text" class="form-control" id="kode" name="kode" value="{{ old('kode', $laporan->kode ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $laporan->nama ?? '') }}" required>
            </div>
            <div class="mb-3">
                <label for="jumlah_terjual" class="form-label">Jumlah Terjual</label>
                <input type="number" class="form-control" id="jumlah_terjual" name="jumlah_terjual" value="{{ old('jumlah_terjual', $laporan->jumlah_terjual ?? '') }}" min="0" required>
            </div>
            <div class="mb-3">
                <label for="harga_satuan" class="form-label">Harga Satuan</label>
                <input type="number" step="0.01" class="form-control" id="harga_satuan" name="harga_satuan" value="{{ old('harga_satuan', $laporan->harga_satuan ?? '') }}" min="0" required>
            </div>
            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="number" step="0.01" class="form-control" id="total" name="total" value="{{ old('total', $laporan->total ?? '') }}" readonly required>
            </div>
            <div class="mb-3">
                <label for="keuntungan" class="form-label">Keuntungan</label>
                <input type="number" step="0.01" class="form-control" id="keuntungan" name="keuntungan" value="{{ old('keuntungan', $laporan->keuntungan ?? '') }}" min="0" required>
            </div>
            <div class="d-flex gap-3">
                <button type="submit" class="btn btn-primary px-4">{{ isset($laporan) ? 'Update' : 'Simpan' }}</button>
<a href="{{ route('laporan_keuangan.index') }}" class="btn btn-danger px-4">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const jumlahInput = document.getElementById('jumlah_terjual');
        const hargaInput = document.getElementById('harga_satuan');
        const totalInput = document.getElementById('total');

        function calculateTotal() {
            const jumlah = parseFloat(jumlahInput.value) || 0;
            const harga = parseFloat(hargaInput.value) || 0;
            const total = jumlah * harga;
            totalInput.value = total.toFixed(2);
        }

        jumlahInput.addEventListener('input', calculateTotal);
        hargaInput.addEventListener('input', calculateTotal);

        // Initial calculation on page load
        calculateTotal();
    });
</script>
@endsection
