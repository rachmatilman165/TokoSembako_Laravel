<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <!-- Tambahkan CSS, misalnya Bootstrap untuk tampilan lebih rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 style="text-align: center;">Laporan Penjualan</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Nama Produk</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transaksis as $laporan)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($laporan->tanggal)) }}</td>

                    <td>{{ $laporan->produk ? $laporan->produk->nama_produk : '-' }}</td>
                    <td>{{ $laporan->sub_total }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data laporan penjualan.</td>
                </tr>
                @endforelse
                <!-- Tambahkan baris lain jika perlu -->
            </tbody>
        </table>
        <table class="table table-bordered table-striped" style="text-align: center;">
            <thead class="table-light">
                <tr>
                    <th>Total Transaksi</th>
                    <th>Total Pendapatan</th>
                    <th>Total Barang Terjual</th>
                    <th>Keuntungan Bersih</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $totalTransaksi ?? 0 }}</td>
                    <td>{{ $totalPendapatan ?? 0 }}</td>
                    <td>{{ $totalBarangTerjual ?? 0 }}</td>
                    <td>{{ $keuntunganBersih ?? 0 }}</td>
                    <!-- Tambahkan baris lain jika perlu -->
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>