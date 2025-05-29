<!DOCTYPE html>
<html>
<head>
    <title>Print Faktur {{ $penjualan->No_Faktur }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        .total { margin-top: 20px; text-align: right; }
    </style>
</head>
<body onload="window.print()">
    <h3>Faktur Penjualan</h3>
    <p><strong>No Faktur:</strong> {{ $penjualan->No_Faktur }}</p>
    <p><strong>Tanggal:</strong> {{ $penjualan->Tgl_Faktur }}</p>
    <p><strong>Customer:</strong> {{ $penjualan->customer->Nama_Customer ?? '-' }}</p>

    <table>
        <thead>
            <tr>
                <th>Kode</th><th>Nama Barang</th><th>Harga</th><th>Qty</th><th>Diskon</th><th>Bruto</th><th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($penjualan->details as $item)
            <tr>
                <td>{{ $item->Kode_Barang }}</td>
                <td>{{ $item->barang->Nama_Barang ?? '-' }}</td>
                <td>{{ number_format($item->Harga) }}</td>
                <td>{{ $item->Qty }}</td>
                <td>{{ number_format($item->Diskon) }}</td>
                <td>{{ number_format($item->Bruto) }}</td>
                <td>{{ number_format($item->Jumlah) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total Bruto:</strong> Rp {{ number_format($penjualan->Total_Bruto) }}</p>
        <p><strong>Total Diskon:</strong> Rp {{ number_format($penjualan->Total_Diskon) }}</p>
        <p><strong>Total Jumlah:</strong> Rp {{ number_format($penjualan->Total_Jumlah) }}</p>
    </div>
</body>
</html>
