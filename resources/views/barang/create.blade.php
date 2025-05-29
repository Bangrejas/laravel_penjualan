@extends('layouts.app') {{-- Jika kamu pakai layout --}}
@section('content')
    <div class="container">
        <h3>Input Barang Baru</h3>
        <form action="{{ route('barang.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="kode_barang" class="form-label">Kode Barang</label>
                <input type="text" class="form-control" id="kode_barang" name="kode_barang" required>
            </div>
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
            </div>
            <div class="mb-3">
                <label for="harga_barang" class="form-label">Harga Barang</label>
                <input type="number" class="form-control" id="harga_barang" name="harga_barang" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan Barang</button>
        </form>
    </div>
@endsection
