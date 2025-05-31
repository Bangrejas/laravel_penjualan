@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Preview Faktur: {{ $penjualan->no_faktur }}</h4>
        </div>
        <div class="card-body">
            <p>Tanggal: {{ $penjualan->tanggal_faktur }}</p>
            <p>Customer: {{ $penjualan->customer->nama_customer }}</p>
            <p>Jenis: {{ $penjualan->jenis->nama_jenis }}</p>

            <table class="table">
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
        </div>
    </div>
@endsection
