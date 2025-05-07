<div class="container mt-5">
    <div class="custom-card">
        <div class="custom-card-header">
            <h2>Detail Transaksi</h2>
        </div>
        <div class="custom-card-body">
            <div class="info">
                <div class="info-item">
                    <span class="info-label">Kode Transaksi:</span>
                    <span class="info-value">{{ $transaksi->kode_transaksi }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Tanggal Transaksi:</span>
                    <span
                        class="info-value">{{ \Carbon\Carbon::parse($transaksi->tanggal_transaksi)->format('d M Y') }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nama Pabrik:</span>
                    <span class="info-value">{{ $transaksi->detailTransaksis->first()->nama_pabrik ?? '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Jumlah Transaksi:</span>
                    <span class="info-value">{{ $transaksi->jumlah_transaksi }}</span>
                </div>
            </div>

            <h3>Detail Item</h3>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nama Pemilik Sawit</th>
                        <th>Timbangan Bersih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi->detailTransaksis as $detail)
                        <tr>
                            <td>{{ $detail->riwayatSortir->penjual->name }}</td>
                            <td>{{ $detail->riwayatSortir->timbangan_bersih ?? '-' }} kg</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="1" class="text-right"><strong>Total:</strong></td>
                        <td class="text-right">Rp.
                            {{ number_format($transaksi->detailTransaksis->first()->harga_jual ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="custom-card-footer">
            <a href="{{ route('transaksis.report') }}" class="custom-button">Kembali</a>
            <button class="custom-button" id="print-button">Print</button>
        </div>
    </div>
</div>

<style>
    .container {
        max-width: 800px;
        margin: auto;
        font-family: Arial, sans-serif;
    }

    .custom-card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .custom-card-header {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: #fff;
        padding: 20px;
        text-align: center;
    }

    .custom-card-body {
        padding: 20px;
    }

    .info {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-bottom: 20px;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        font-size: 16px;
        font-weight: 500;
    }

    .info-label {
        color: #6a11cb;
    }

    .info-value {
        color: #333;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .custom-table th,
    .custom-table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    .custom-table th {
        background: #6a11cb;
        color: #fff;
    }

    .custom-table tr:nth-child(even) {
        background: #f9f9f9;
    }

    .custom-table td.text-right {
        text-align: right;
    }

    .custom-card-footer {
        padding: 20px;
        text-align: right;
        background: #f1f1f1;
    }

    .custom-button {
        background: #6a11cb;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .custom-button:hover {
        background: #2575fc;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const button = document.querySelector('.custom-button');
        button.addEventListener('mouseover', function() {
            button.style.background = '#2575fc';
        });
        button.addEventListener('mouseout', function() {
            button.style.background = '#6a11cb';
        });

        const printButton = document.getElementById('print-button');
        printButton.addEventListener('click', function() {
            const printContent = document.querySelector('.custom-card-body').innerHTML;
            const originalContent = document.body.innerHTML;

            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
            window.location.reload();
        });
    });
</script>
