<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-details,
        .sortir-details {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p>No Invoice: {{ $transaksi->no_invoice }}</p>
        <p>Nama Pabrik: {{ $transaksi->nama_pabrik }}</p>
        <p>Tanggal: {{ $transaksi->created_at->format('d-m-Y') }}</p>
    </div>

    <div class="sortir-details">
        <h2>Detail Sortir</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Sortir</th>
                    <th>Penjual</th>
                    <th>Timbangan Bersih</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($transaksi->sortir_ids) && is_array($transaksi->sortir_ids))
                    @foreach ($transaksi->sortir_ids as $sortirId)
                        @php
                            $sortir = \App\Models\Sortir::find($sortirId);
                        @endphp
                        @if ($sortir)
                            <tr>
                                <td>{{ $sortir->id }}</td>
                                <td>{{ $sortir->penjual->name }}</td>
                                <td>{{ $sortir->timbangan_bersih }}</td>
                                <td>{{ $sortir->status }}</td>
                            </tr>
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Tidak ada data sortir yang tersedia.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="invoice-details">
        <h2>Detail Transaksi</h2>
        <p>Harga Jual: Rp {{ number_format($transaksi->harga_jual, 2) }}</p>
        <p>Keuntungan: Rp {{ number_format($transaksi->profit, 2) }}</p>
    </div>
</body>

</html>
