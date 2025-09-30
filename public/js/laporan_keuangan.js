function handleTambahLaporan() {
    const activeTab = document.querySelector('#laporanTabs .nav-link.active').id;
    let targetUrl = '';
    if (activeTab === 'penjualan-tab') {
        targetUrl = "{{ url('tambah_laporan_penjualan_barang') }}";
    } else if (activeTab === 'pendapatan-tab') {
        targetUrl = "{{ url('tambah_laporan_pendapatan_lain') }}";
    } else if (activeTab === 'pengeluaran-tab') {
        targetUrl = "{{ url('tambah_laporan_pengeluaran') }}";
    }
    if (targetUrl) {
        window.location.href = targetUrl;
    }
}
