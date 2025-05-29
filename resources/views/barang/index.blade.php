@extends('layouts.app') {{-- Jika kamu pakai layout --}}
@section('content')
    <div class="container">
        <h3>Daftar Barang</h3>
        {{-- <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Input Penjualan Baru</a> --}}

        <table class="table-bordered table">
            <thead>
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $b)
                    <tr>
                        <td>{{ $b->kode_barang }}</td>
                        <td>{{ $b->nama_barang }}</td>
                        <td>{{ $b->harga_barang }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
