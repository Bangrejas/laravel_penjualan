@extends('layouts.app') {{-- Jika kamu pakai layout --}}
@section('content')
    <div class="container">
        <h3>Daftar Customer</h3>
        <a href="{{ route('customer.create') }}" class="btn btn-primary mb-3">Buat Customer</a>

        <table class="table-bordered table">
            <thead>
                <tr>
                    <th>Kode Customer</th>
                    <th>Nama Customer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $c)
                    <tr>
                        <td>{{ $c->kode_customer }}</td>
                        <td>{{ $c->nama_customer }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
