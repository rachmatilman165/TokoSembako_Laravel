<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <!-- Tambahkan CSS, misalnya Bootstrap untuk tampilan lebih rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 style="text-align: center;">Laporan Keuangan</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jumlah Terjual</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
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
                </tr>
                @endforeach
                <!-- Tambahkan baris lain jika perlu -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" class="text-end">Sub Total</td>
                    <td>Rp. {{ number_format($transaksis->sum('sub_total'), 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>