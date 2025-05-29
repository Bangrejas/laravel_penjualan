@extends('layouts.app') {{-- Jika kamu pakai layout --}}
@section('content')
    <div class="container">
        <h3>Input Customer Baru</h3>
        <form action="{{ route('customer.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="kode_customer" class="form-label">Kode Customer</label>
                <input type="text" class="form-control" id="kode_customer" name="kode_customer" required>
            </div>
            <div class="mb-3">
                <label for="nama_customer" class="form-label">Nama Customer</label>
                <input type="text" class="form-control" id="nama_customer" name="nama_customer" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
