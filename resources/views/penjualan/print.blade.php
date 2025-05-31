<!DOCTYPE html>
<html>

<head>
    <title>Faktur #{{ $penjualan->no_faktur }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f0f0f0;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <h2>Faktur Penjualan</h2>
    <p><strong>No Faktur:</strong> {{ $penjualan->no_faktur }}</p>
    <p><strong>Tanggal:</strong> {{ $penjualan->tanggal_faktur }}</p>
    <p><strong>Customer:</strong> {{ $penjualan->customer->nama_customer }}</p>
    <p><strong>Jenis:</strong> {{ $penjualan->jenis->nama_jenis }}</p>

    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Diskon</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualan->dijual as $item)
                <tr>
                    <td>{{ $item->barang->nama_barang }}</td>
                    <td>{{ number_format($item->harga) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->diskon }}%</td>
                    <td>{{ number_format($item->jumlah) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <button onclick="window.print()" class="no-print">Print</button>
</body>

</html>
