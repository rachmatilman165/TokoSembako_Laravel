<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <!-- Tambahkan CSS, misalnya Bootstrap untuk tampilan lebih rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 style="text-align: center;">Data Produk</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Supplier</th>
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
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data produk.</td>
                </tr>
                @endforelse
                <!-- Tambahkan baris lain jika perlu -->
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>

</html>