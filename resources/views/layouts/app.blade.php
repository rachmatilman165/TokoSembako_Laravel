<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title', 'Toko Sembako Damai')</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #007bff;">
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-3 me-lg-0 text-white" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white d-flex align-items-center" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw me-2"></i> {{ Auth::user()->name ?? 'Admin' }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown" method="POST">
                    <li><a class="dropdown-item" href="{{ route('logout') }} ">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav d-flex flex-column align-items-center pt-3">
                        <img src="{{ asset('assets/img/logo.png') }}" alt="Logo" style="width: 80px; height: 80px;" />
                        <h5 class="mt-2 mb-4 text-primary">Toko Sembako Damai</h5>
                    </div>
                    <div class="nav flex-column px-3">
                        <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
                        <a class="nav-link" href="{{ route('transaksi.index') }}">Transaksi Penjualan</a>
                        <a class="nav-link" href="{{ route('transaksi_pembelian.index') }}">Transaksi Pembelian</a>
                        <a class="nav-link" href="{{ route('produk.index') }}">Produk</a>
                        <a class="nav-link" href="{{ route('supplier.index') }}">Supplier</a>
                        <a class="nav-link" href="{{ route('konsumen.index') }}">Konsumen</a>
                        <a class="nav-link" href="{{ route('laporan_stok.index') }}">Laporan Stok Barang</a>
                        <a class="nav-link" href="{{ route('laporan_keuangan.index') }}">Laporan Keuangan</a>
                        <a class="nav-link" href="{{ route('laporan_penjualan.index') }}">Laporan Penjualan</a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    {{ Auth::user()->name ?? 'Admin' }}
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
                    @yield('content')
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Toko Sembako Damai 2024</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>
    <script src="{{ asset('js/logout.js') }}"></script>
</body>

</html>