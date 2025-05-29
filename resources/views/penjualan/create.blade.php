@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Input Transaksi Penjualan</h3>
    <form action="{{ route('penjualan.store') }}" method="POST" id="form-penjualan">
        @csrf

        {{-- HEADER --}}
        <div class="card p-3 mb-3">
            <div class="row">
                <div class="col-md-3">
                    <label>No Faktur</label>
                    <input type="text" name="No_Faktur" class="form-control" value="{{ $newNoFaktur }}" readonly>
                </div>
                <div class="col-md-3">
                    <label>Tanggal</label>
                    <input type="date" name="Tgl_Faktur" class="form-control" value="{{ date('Y-m-d') }}">
                </div>
                <div class="col-md-3">
                    <label>Customer</label>
                    <select name="Kode_Customer" class="form-control">
                        @foreach($customers as $c)
                            <option value="{{ $c->Kode_Customer }}">{{ $c->Nama_Customer }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Jenis Transaksi</label>
                    <select name="Kode_Tjen" class="form-control">
                        @foreach($jenis as $j)
                            <option value="{{ $j->Kode_Tjen }}">{{ $j->Nama_Tjen }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- DETAIL --}}
        <div class="card p-3 mb-3">
            <h5>Detail Barang</h5>
            <table class="table" id="tabel-detail">
                <thead>
                    <tr>
                        <th>Kode</th><th>Nama</th><th>Harga</th><th>Qty</th><th>Diskon</th><th>Bruto</th><th>Jumlah</th><th>#</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <button type="button" class="btn btn-sm btn-secondary" onclick="tambahBaris()">+ Tambah Barang</button>
        </div>

        {{-- TOTAL --}}
        <div class="card p-3 mb-3">
            <div class="row">
                <div class="col-md-4 offset-md-8">
                    <label>Total Bruto</label>
                    <input type="text" name="Total_Bruto" class="form-control" readonly>
                    <label>Total Diskon</label>
                    <input type="text" name="Total_Diskon" class="form-control" readonly>
                    <label>Total Jumlah</label>
                    <input type="text" name="Total_Jumlah" class="form-control" readonly>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

<script>
function tambahBaris() {
    let index = $('#tabel-detail tbody tr').length;

    let row = `<tr>
        <td><input name="detail[${index}][Kode_Barang]" class="form-control kode-barang" placeholder="Cari kode/nama"></td>
        <td><input class="form-control nama-barang" readonly></td>
        <td><input name="detail[${index}][Harga]" class="form-control harga" readonly></td>
        <td><input name="detail[${index}][Qty]" class="form-control qty" type="number" min="1" value="1"></td>
        <td><input name="detail[${index}][Diskon]" class="form-control diskon" type="number" min="0" value="0"></td>
        <td><input name="detail[${index}][Bruto]" class="form-control bruto" readonly></td>
        <td><input name="detail[${index}][Jumlah]" class="form-control jumlah" readonly></td>
        <td><button type="button" class="btn btn-danger btn-sm" onclick="hapusBaris(this)">X</button></td>
    </tr>`;

    $('#tabel-detail tbody').append(row);

    $('#tabel-detail tbody tr:last .kode-barang').autocomplete({
        source: function(request, response) {
            $.getJSON('/barang/search?q=' + request.term, function(data) {
                response($.map(data, function(item) {
                    return {
                        label: item.label,    // <-- periksa properti ini dari response
                        value: item.value,
                        nama: item.nama,
                        harga: item.harga
                    };
                }));
            });
        },
        select: function(event, ui) {
            event.preventDefault();
            let row = $(this).closest('tr');
            $(this).val(ui.item.value);
            row.find('.nama-barang').val(ui.item.nama);
            row.find('.harga').val(ui.item.harga);
            row.find('.qty').trigger('input');
        }
    });
}

function hapusBaris(btn) {
    $(btn).closest('tr').remove();
    hitungTotal();
}

$(document).on('input', '.qty, .diskon', function() {
    let row = $(this).closest('tr');
    let harga = parseFloat(row.find('.harga').val() || 0);
    let qty = Math.max(1, parseFloat(row.find('.qty').val() || 1));
    let diskon = Math.max(0, parseFloat(row.find('.diskon').val() || 0));

    row.find('.qty').val(qty);
    row.find('.diskon').val(diskon);

    let bruto = harga * qty;
    let diskonRp = bruto * (diskon / 100);
    let jumlah = bruto - diskonRp;

    row.find('.bruto').val(bruto.toFixed(2));
    row.find('.jumlah').val(jumlah.toFixed(2));

    hitungTotal();
});

function hitungTotal() {
    let totalBruto = 0, totalDiskon = 0, totalJumlah = 0;

    $('#tabel-detail tbody tr').each(function() {
        let harga = parseFloat($(this).find('.harga').val() || 0);
        let qty = parseFloat($(this).find('.qty').val() || 0);
        let diskon = parseFloat($(this).find('.diskon').val() || 0);

        let bruto = harga * qty;
        let diskonRp = bruto * (diskon / 100);
        let jumlah = bruto - diskonRp;

        totalBruto += bruto;
        totalDiskon += diskonRp;
        totalJumlah += jumlah;
    });

    $('input[name=Total_Bruto]').val(totalBruto.toFixed(2));
    $('input[name=Total_Diskon]').val(totalDiskon.toFixed(2));
    $('input[name=Total_Jumlah]').val(totalJumlah.toFixed(2));
}
</script>
@endpush
