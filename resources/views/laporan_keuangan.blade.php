@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <a href="{{ route('printc') }}" class="btn btn-primary mb-3"><i class="fa-solid fa-print"></i> Cetak</a>
    <div class="card">
        <div class="card-header">
            Laporan Keuangan
        </div>
        <div class="card-body">
            <!-- <form class="row g-3 align-items-center mb-3">
                <div class="col-auto">
                    <button type="button" class="btn btn-primary" id="printLaporanKeuanganBtn">Cetak</button>
                </div>
            </form> -->

            <div class="tab-content" id="laporanTabsContent">
                <div class="tab-pane fade show active" id="penjualan" role="tabpanel" aria-labelledby="penjualan-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jumlah Terjual</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksis as $laporan)
                            <tr>
                                <td>{{ $laporan->transaksi_id }}</td>
                                <td>{{ $laporan->produk ? $laporan->produk->nama_produk : '-' }}</td>
                                <td>{{ $laporan->jumlah }}</td>
                                <td>{{ $laporan->total }}</td>
                                <td>{{ $laporan->sub_total }}</td>
                                <td>
                                    <form action="{{ route('transaksi.destroy', $laporan->produk_id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-end">Sub Total</td>
                                <td>Rp. {{ number_format($transaksis->sum('sub_total'), 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="tab-pane fade" id="pendapatan" role="tabpanel" aria-labelledby="pendapatan-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Sumber Pendapatan</th>
                                <th>Harga</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporanPendapatanLain as $laporan)
                            <tr>
                                <td>{{ $laporan->kode }}</td>
                                <td>{{ $laporan->sumber_pendapatan }}</td>
                                <td>Rp. {{ number_format($laporan->harga, 2) }}</td>
                                <td>{{ $laporan->keterangan }}</td>
                                <td>
                                    <a href="{{ route('laporan_pendapatan_lain.edit', $laporan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('laporan_pendapatan_lain.destroy', $laporan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end">Sub Total</td>
                                <td>Rp. {{ number_format($laporanPendapatanLain->sum('harga'), 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="tab-pane fade" id="pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Kategori</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($laporanPengeluaran as $laporan)
                            <tr>
                                <td>{{ $laporan->kode }}</td>
                                <td>{{ $laporan->kategori }}</td>
                                <td>Rp. {{ number_format($laporan->total, 2) }}</td>
                                <td>{{ $laporan->keterangan }}</td>
                                <td>
                                    <a href="{{ route('laporan_pengeluaran.edit', $laporan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('laporan_pengeluaran.destroy', $laporan->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end">Sub Total</td>
                                <td>Rp. {{ number_format($laporanPengeluaran->sum('total'), 2) }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="small text-muted">Showing {{ $transaksis->count() }} entries</div>
        </div>
    </div>
</div>
<script>
    const tambahLaporanPenjualanUrl = "{{ route('laporan_penjualan_barang.create') }}";
    const tambahLaporanPendapatanUrl = "{{ route('laporan_pendapatan_lain.create') }}";
    const tambahLaporanPengeluaranUrl = "{{ route('laporan_pengeluaran.create') }}";

    function handleTambahLaporan() {
        const activeTab = document.querySelector('#laporanTabs .nav-link.active').id;
        let targetUrl = '';
        if (activeTab === 'penjualan-tab') {
            targetUrl = tambahLaporanPenjualanUrl;
        } else if (activeTab === 'pendapatan-tab') {
            targetUrl = tambahLaporanPendapatanUrl;
        } else if (activeTab === 'pengeluaran-tab') {
            targetUrl = tambahLaporanPengeluaranUrl;
        }
        if (targetUrl) {
            window.location.href = targetUrl;
        }
    }
</script>
<script src="{{ asset('js/laporan_keuangan_print.js') }}"></script>
@endsection