@extends('layouts.app') {{-- Jika kamu pakai layout --}}
@section('content')
    <h3>Daftar Penjualan</h3>
    <a href="{{ route('barang.index') }}" class="btn btn-primary mb-3">Master Barang</a>
    <a href="{{ route('customer.index') }}" class="btn btn-primary mb-3">Master Customer</a>
    <!-- <pre>{{ print_r($penjualans, true) }}</pre> -->

    <table class="table-bordered table">
        <thead>
            <tr>
                <th>No Faktur</th>
                <th>Tanggal</th>
                <th>Customer</th>
                <th>Total Jumlah</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penjualans as $p)
                <tr>
                    <td>{{ $p->No_Faktur }}</td>
                    <td>{{ $p->Tgl_Faktur }}</td>
                    <td>{{ $p->customer->Nama_Customer ?? '-' }}</td>
                    <td>{{ number_format($p->Total_Jumlah) }}</td>
                    <td>
                        <a href="{{ route('penjualan.print', $p->No_Faktur) }}" class="btn btn-sm btn-secondary">Print</a>
                        <a href="{{ route('penjualan.csv', $p->No_Faktur) }}" class="btn btn-sm btn-success">CSV</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
