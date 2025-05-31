@extends('layouts.app') {{-- Jika kamu pakai layout --}}
@section('content')
    <a href="{{ route('barang.index') }}" class="btn btn-primary mb-3">Master Barang</a>
    <a href="{{ route('customer.index') }}" class="btn btn-primary mb-3">Master Customer</a>
    <!-- <pre>{{ print_r($penjualans, true) }}</pre> -->

    {{-- HEADER TRANSAKSI --}}
    <form action="{{ route('penjualan.store') }}" method="POST">
        @csrf

        {{-- Bagian Header --}}
        <div class="card mb-3">
            <div class="card-header">Informasi Faktur</div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4">
                        <label>No Faktur</label>
                        <input type="text" name="no_faktur" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Tanggal</label>
                        <input type="date" name="tgl_faktur" class="form-control" required>
                    </div>
                    <div class="col-md-4">
                        <label>Jenis Transaksi</label>
                        <select name="kode_jenis" class="form-control" required>
                            @foreach ($jenis as $j)
                                <option value="{{ $j->kode_jenis }}">{{ $j->nama_jenis }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>
                <div class="row">
                    <div class="">
                        <label>Kode Customer</label>
                        <select name="kode_customer" class="form-control" required>
                            @foreach ($customers as $c)
                                <option value="{{ $c->kode_customer }}">{{ $c->nama_customer }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>


        {{-- Bagian Detail Barang --}}
        <div class="card mb-3">
            <div class="card-header">Detail Barang</div>
            <div class="card-body">
                <table class="table-bordered table" id="barang-table">
                    <thead>
                        <tr>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Diskon (%)</th>
                            <th>Bruto</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="barang-body">
                        <tr>
                            <td>
                                <select name="kode_barang[]" class="form-control kode-barang" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach ($barangs as $b)
                                        <option value="{{ $b->kode_barang }}" data-nama="{{ $b->nama_barang }}"
                                            data-harga="{{ $b->harga_barang }}"> {{ $b->kode_barang }} </option>
                                    @endforeach
                                </select>
                            </td>
                            <td><input type="text" name="nama_barang" class="form-control nama-barang" readonly></td>
                            <td>
                                <input type="number" name="harga[]" class="form-control harga-barang" readonly>
                            </td>
                            <td>
                                <input type="number" name="qty[]" class="form-control qty-barang" required>
                            </td>
                            <td>
                                <input type="number" name="diskon[]" class="form-control diskon-barang">
                            </td>
                            <td>
                                <input type="text" name="bruto[]" class="form-control bruto-barang" readonly>
                            </td>
                            <td>
                                <input type="text" name="jumlah[]" class="form-control jumlah-barang" readonly>
                            </td>
                        </tr>
                    </tbody>
                </table>

                {{-- Tombol Tambah Barang --}}
                <button type="button" class="btn btn-secondary" onclick="tambahBarang()">+ Tambah Barang</button>
            </div>
        </div>

        {{-- Tabel Faktur Penjualan --}}
        <div class="card mb-3">
            <div class="card-header">Faktur Penjualan</div>
            <div class="card-body">
                <table class="table-bordered table">
                    <thead>
                        <tr>
                            <th>No Faktur</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Quantity</th>
                            <th>Diskon</th>
                            <th>Bruto</th>
                            <th>Jumlah</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualans as $p)
                            <tr>
                                <td class="table-secondary font-weight-bold" colspan="8">{{ $p->no_faktur }}
                                </td>
                                <td colspan="1">
                                    <a href="{{ route('penjualan.detail', $p->id) }}"
                                        class="btn btn-secondary btn-sm">Detail</a>
                                    <a href="{{ route('penjualan.print', $p->id) }}"
                                        class="btn btn-secondary btn-sm">Cetak</a>
                                    <a href="{{ route('penjualan.export', $p->id) }}"
                                        class="btn btn-secondary btn-sm">Export CSV</a>
                                </td>
                            </tr>
                            @foreach ($p->dijual as $item)
                                <tr>
                                    <td></td> {{-- Kosong karena no faktur sudah ditampilkan di baris atas --}}
                                    <td>{{ $item->kode_barang }}</td>
                                    <td>{{ $item->barang->nama_barang ?? '-' }}</td>
                                    <td>{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->diskon }}%</td>
                                    <td>{{ number_format($item->brutto, 0, ',', '.') }}</td>
                                    <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach

                            {{-- Optional: total per faktur --}}
                            <tr class="table-success font-weight-bold">
                                <td colspan="5" class="text-right">Total</td>
                                <td>{{ number_format($p->dijual->sum('diskon'), 2) }}%</td>
                                <td>{{ number_format($p->dijual->sum('brutto'), 0, ',', '.') }}</td>
                                <td>{{ number_format($p->dijual->sum('jumlah'), 0, ',', '.') }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        {{-- Bagian Total --}}
        <div class="card mb-3">
            <div class="card-header">Total</div>
            <div class="card-body">
                <div class="form-group">
                    <label>Total Bruto</label>
                    <input type="text" name="total_bruto" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Total Diskon</label>
                    <input type="text" name="total_diskon" class="form-control" readonly>
                </div>
                <div class="form-group">
                    <label>Total Jumlah</label>
                    <input type="text" name="total_jumlah" class="form-control" readonly>
                </div>
            </div>
        </div>

        {{-- Tombol Simpan --}}
        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const barangBody = document.getElementById('barang-body');

            // Saat kode_barang berubah
            barangBody.addEventListener('change', function(e) {
                if (e.target.classList.contains('kode-barang')) {
                    const selected = e.target.options[e.target.selectedIndex];
                    const tr = e.target.closest('tr');

                    tr.querySelector('.nama-barang').value = selected.getAttribute('data-nama') || '';
                    tr.querySelector('.harga-barang').value = selected.getAttribute('data-harga') || '';

                    // Reset nilai lain
                    tr.querySelector('.qty-barang').value = '';
                    tr.querySelector('.diskon-barang').value = '';
                    tr.querySelector('.bruto-barang').value = '';
                    tr.querySelector('.jumlah-barang').value = '';
                }
            });

            // Saat qty atau diskon diubah
            barangBody.addEventListener('input', function(e) {
                if (
                    e.target.classList.contains('qty-barang') ||
                    e.target.classList.contains('diskon-barang')
                ) {
                    const tr = e.target.closest('tr');
                    const harga = parseFloat(tr.querySelector('.harga-barang').value) || 0;
                    const qty = parseFloat(tr.querySelector('.qty-barang').value) || 0;
                    const diskon = parseFloat(tr.querySelector('.diskon-barang').value) || 0;

                    const bruto = harga * qty;
                    const jumlah = bruto - diskon * bruto / 100;

                    tr.querySelector('.diskon-barang').value = diskon.toFixed(2);
                    tr.querySelector('.bruto-barang').value = bruto.toFixed(2);
                    tr.querySelector('.jumlah-barang').value = jumlah.toFixed(2);

                    hitungTotal(); // 🟢 Tambahkan ini agar total otomatis terupdate
                }
            });
        });

        function hitungTotal() {
            let totalBruto = 0;
            let totalDiskon = 0;
            let totalJumlah = 0;

            document.querySelectorAll('#barang-body tr').forEach(tr => {
                totalBruto += parseFloat(tr.querySelector('.bruto-barang').value) || 0;
                totalDiskon += parseFloat(tr.querySelector('.diskon-barang').value) || 0;
                totalJumlah += parseFloat(tr.querySelector('.jumlah-barang').value) || 0;
            });

            document.querySelector('[name="total_bruto"]').value = totalBruto.toFixed(2);
            document.querySelector('[name="total_diskon"]').value = totalDiskon.toFixed(2);
            document.querySelector('[name="total_jumlah"]').value = totalJumlah.toFixed(2);
        }

        function tambahBarang() {
            const barangBody = document.getElementById('barang-body');
            const lastRow = barangBody.querySelector('tr:last-child');

            // Clone baris terakhir
            const newRow = lastRow.cloneNode(true);

            // Kosongkan nilai input di baris baru
            newRow.querySelectorAll('input').forEach(input => {
                input.value = '';
            });

            newRow.querySelector('.kode-barang').selectedIndex = 0;

            barangBody.appendChild(newRow);

            hitungTotal(); // Hitung total setelah menambah baris baru
        }
    </script>
@endsection
