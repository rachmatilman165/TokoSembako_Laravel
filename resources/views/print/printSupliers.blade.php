<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <!-- Tambahkan CSS, misalnya Bootstrap untuk tampilan lebih rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2 style="text-align: center;">Data Suppliers</h2>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>id</th>
                    <th>Nama Supplier</th>
                    <th>Alamat</th>
                    <th>No. Hp</th>
                </tr>
            </thead>
            <tbody>
                @forelse($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->nama_supplier }}</td>
                    <td>{{ $supplier->alamat }}</td>
                    <td>{{ $supplier->telepon }}</td>
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