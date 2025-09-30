document.addEventListener('DOMContentLoaded', () => {
    const printLaporanKeuanganBtn = document.getElementById('printLaporanKeuanganBtn');
    if (printLaporanKeuanganBtn) {
        printLaporanKeuanganBtn.addEventListener('click', () => {
            const activeTab = document.querySelector('#laporanTabs .nav-link.active');
            if (!activeTab) {
                alert('Tidak ada tab aktif yang dipilih.');
                return;
            }
            const targetId = activeTab.getAttribute('data-bs-target');
            const tabContent = document.querySelector(targetId);
            if (!tabContent) {
                alert('Konten tab tidak ditemukan.');
                return;
            }
            const table = tabContent.querySelector('table');
            if (!table) {
                alert('Tabel tidak ditemukan di tab aktif.');
                return;
            }

            // Clone the table to manipulate before printing
            const clonedTable = table.cloneNode(true);

            // Remove the last column (Aksi) from the header
            const headerRow = clonedTable.querySelector('thead tr');
            if (headerRow) {
                const lastHeaderCell = headerRow.lastElementChild;
                if (lastHeaderCell) {
                    lastHeaderCell.remove();
                }
            }

            // Remove the last column from each body row
            const bodyRows = clonedTable.querySelectorAll('tbody tr');
            bodyRows.forEach(row => {
                const lastCell = row.lastElementChild;
                if (lastCell) {
                    lastCell.remove();
                }
            });

            // Remove the last column from each footer row if exists
            const footerRows = clonedTable.querySelectorAll('tfoot tr');
            footerRows.forEach(row => {
                const lastCell = row.lastElementChild;
                if (lastCell) {
                    lastCell.remove();
                }
            });

            let title = '';
            if (targetId === '#penjualan') {
                title = 'Laporan Penjualan Barang';
            } else if (targetId === '#pendapatan') {
                title = 'Laporan Pendapatan Lain';
            } else if (targetId === '#pengeluaran') {
                title = 'Laporan Pengeluaran';
            }

            let printWindow = window.open('', 'Print Laporan Keuangan', 'width=900,height=700');
            let content = `
                <html>
                <head>
                    <title>${title}</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        h2 { text-align: center; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                        tfoot td { font-weight: bold; }
                    </style>
                </head>
                <body>
                    <h2>${title}</h2>
                    ${clonedTable.outerHTML}
                </body>
                </html>
            `;
            printWindow.document.write(content);
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        });
    }
});
