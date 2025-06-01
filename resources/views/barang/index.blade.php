@extends('layouts.app') {{-- Jika kamu pakai layout --}}
@section('content')
    <div class="container">
        <h3>Daftar Barang</h3>
        <a href="{{ route('barang.create') }}" class="btn btn-primary mb-3">Buat Barang</a>

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
                        <td>
                            <form action="{{ route('barang.destroy', $b->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
