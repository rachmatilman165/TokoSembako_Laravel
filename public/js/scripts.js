/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
// 
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Content from transaksi.js
    const addItemBtn = document.getElementById('addItemBtn');
    const itemsTableBody = document.getElementById('itemsTableBody');
    const subTotalInput = document.getElementById('subTotal');

    // produk data from blade
    const produkData = window.produkData || [];

    // Function to recalculate subtotal
    function recalculateSubTotal() {
        let subtotal = 0;
        const rows = itemsTableBody.querySelectorAll('tr');
        rows.forEach(row => {
            const totalCell = row.querySelector('.item-total');
            if (totalCell) {
                subtotal += parseFloat(totalCell.textContent) || 0;
            }
        });
        subTotalInput.value = subtotal.toFixed(2);
    }

    // Function to create a new item row
    function createItemRow() {
        const row = document.createElement('tr');

        // id cell (input)
        const idCell = document.createElement('td');
        const idInput = document.createElement('input');
        idInput.type = 'text';
        idInput.className = 'form-control form-control-sm';
        idInput.placeholder = 'id';
        idCell.appendChild(idInput);
        row.appendChild(idCell);

        // Nama Produk cell (select)
        const nameCell = document.createElement('td');
        const nameSelect = document.createElement('select');
        nameSelect.className = 'form-control form-control-sm';
        const defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.textContent = '-- Pilih Produk --';
        nameSelect.appendChild(defaultOption);
        produkData.forEach(produk => {
            const option = document.createElement('option');
            option.value = produk.id;
            option.textContent = produk.nama_produk;
            option.dataset.price = produk.harga;
            nameSelect.appendChild(option);
        });
        nameCell.appendChild(nameSelect);
        row.appendChild(nameCell);

        // Jumlah cell (input number)
        const qtyCell = document.createElement('td');
        const qtyInput = document.createElement('input');
        qtyInput.type = 'number';
        qtyInput.className = 'form-control form-control-sm';
        qtyInput.min = '1';
        qtyInput.value = '1';
        qtyCell.appendChild(qtyInput);
        row.appendChild(qtyCell);

        // Total cell (calculated)
        const totalCell = document.createElement('td');
        totalCell.className = 'item-total';
        totalCell.textContent = '0.00';
        row.appendChild(totalCell);

        // Action cell (delete button)
        const actionCell = document.createElement('td');
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'btn btn-danger btn-sm';
        deleteBtn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16"><path d="M6.5 1a1 1 0 0 1 1 1v1h-1V2a1 1 0 0 1 1-1z"/><path d="M11 4v9a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V4h6z"/><path fill-rule="evenodd" d="M4.5 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 .5.5v.5H4v-.5z"/></svg>';
        deleteBtn.addEventListener('click', () => {
            row.remove();
            recalculateSubTotal();
        });
        actionCell.appendChild(deleteBtn);
        row.appendChild(actionCell);

        // Update total when product or quantity changes
        function updateTotal() {
            const selectedOption = nameSelect.options[nameSelect.selectedIndex];
            const price = selectedOption ? parseFloat(selectedOption.dataset.price) || 0 : 0;
            const qty = parseInt(qtyInput.value) || 1;
            const total = price * qty;
            totalCell.textContent = total.toFixed(2);
            recalculateSubTotal();
        }

        nameSelect.addEventListener('change', updateTotal);
        qtyInput.addEventListener('input', updateTotal);

        return row;
    }

    if (addItemBtn) {
        addItemBtn.addEventListener('click', () => {
            const newRow = createItemRow();
            itemsTableBody.appendChild(newRow);
        });
    }

    // Add print receipt functionality
    const printReceiptBtn = document.getElementById('printReceiptBtn');
    if (printReceiptBtn) {
        printReceiptBtn.addEventListener('click', () => {
            let receiptWindow = window.open('', 'Print Receipt', 'width=600,height=600');
            let receiptContent = `
                <html>
                <head>
                    <title>Struk Belanja</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        h2 { text-align: center; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                        tfoot td { font-weight: bold; }
                    </style>
                </head>
                <body>
                    <h2>Struk Belanja</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            const rows = itemsTableBody.querySelectorAll('tr');
            rows.forEach(row => {
                const id = row.querySelector('td:nth-child(1) input').value;
                const nameSelect = row.querySelector('td:nth-child(2) select');
                const name = nameSelect ? nameSelect.options[nameSelect.selectedIndex].text : '';
                const qty = row.querySelector('td:nth-child(3) input').value;
                const total = row.querySelector('.item-total').textContent;
                receiptContent += `
                    <tr>
                        <td>${id}</td>
                        <td>${name}</td>
                        <td>${qty}</td>
                        <td>${total}</td>
                    </tr>
                `;
            });

            receiptContent += `
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3">Sub Total</td>
                                <td>${subTotalInput.value}</td>
                            </tr>
                        </tfoot>
                    </table>
                </body>
                </html>
            `;

            receiptWindow.document.write(receiptContent);
            receiptWindow.document.close();
            receiptWindow.focus();
            receiptWindow.print();
            receiptWindow.close();
        });
    }

    // Add print stock report functionality
    const printStockReportBtn = document.getElementById('printStockReportBtn');
    if (printStockReportBtn) {
        printStockReportBtn.addEventListener('click', () => {
            let stockWindow = window.open('', 'Print Stock Report', 'width=800,height=600');
            let stockContent = `
                <html>
                <head>
                    <title>Laporan Stok Barang</title>
                    <style>
                        body { font-family: Arial, sans-serif; padding: 20px; }
                        h2 { text-align: center; }
                        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                    </style>
                </head>
                <body>
                    <h2>Laporan Stok Barang</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Stok Awal</th>
                                <th>Barang Masuk</th>
                                <th>Barang Keluar</th>
                                <th>Stok Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            const stockRows = document.querySelectorAll('.card-body table tbody tr');
            stockRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length > 0) {
                    const kode = cells[0].textContent.trim();
                    const nama = cells[1].textContent.trim();
                    const stokAwal = cells[2].textContent.trim();
                    const barangMasuk = cells[3].textContent.trim();
                    const barangKeluar = cells[4].textContent.trim();
                    const stokAkhir = cells[5].textContent.trim();

                    stockContent += `
                        <tr>
                            <td>${kode}</td>
                            <td>${nama}</td>
                            <td>${stokAwal}</td>
                            <td>${barangMasuk}</td>
                            <td>${barangKeluar}</td>
                            <td>${stokAkhir}</td>
                        </tr>
                    `;
                }
            });

            stockContent += `
                        </tbody>
                    </table>
                </body>
                </html>
            `;

            stockWindow.document.write(stockContent);
            stockWindow.document.close();
            stockWindow.focus();
            stockWindow.print();
            stockWindow.close();
        });
    }


});
