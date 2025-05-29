<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penjualan;
use App\Models\Djual;
use App\Models\Customer;
use App\Models\JenisTransaksi;
use App\Models\Barang;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('customer')->get();
        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $customers = Customer::all();
        $jenis = JenisTransaksi::all();

        // generate no faktur otomatis (contoh: FKT-0001)
        $last = Penjualan::orderBy('No_Faktur', 'desc')->first();
        $nextNumber = $last ? ((int)substr($last->No_Faktur, 4)) + 1 : 1;
        $newNoFaktur = 'FKT-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return view('penjualan.create', compact('customers', 'jenis', 'newNoFaktur'));
    }

    public function store(Request $request)
    {
        // dd($request->detail[0]);
        // dd($request->all());
        
        // Validasi input minimal
        $request->validate([
            'No_Faktur' => 'required',
            'Kode_Customer' => 'required',
            'Kode_Tjen' => 'required',
            'Tgl_Faktur' => 'required',
            'Total_Bruto' => 'required|numeric',
            'Total_Diskon' => 'required|numeric',
            'Total_Jumlah' => 'required|numeric',
            'detail' => 'required|array|min:1',
            'Total_Netto' => $request->Total_Jumlah,
        ]);

        DB::beginTransaction();

        try {
            // Simpan header transaksi (t_jual)
            $penjualan = Penjualan::create([
                'No_Faktur' => $request->No_Faktur,
                'Kode_Customer' => $request->Kode_Customer,
                'Kode_Tjen' => $request->Kode_Tjen,
                'Tgl_Faktur' => $request->Tgl_Faktur,
                'Total_Bruto' => $request->Total_Bruto,
                'Total_Diskon' => $request->Total_Diskon,
                'Total_Jumlah' => $request->Total_Jumlah,
            ]);

            // Simpan detail transaksi (t_djual)
            foreach ($request->detail as $item) {
                if (!isset($item['Kode_Barang'])) continue;

                Djual::create([
                    'No_Faktur' => $request->No_Faktur,
                    'Kode_Barang' => $item['Kode_Barang'],
                    'Harga' => $item['Harga'],
                    'Qty' => $item['Qty'],
                    'Diskon' => $item['Diskon'],
                    'Bruto' => $item['Bruto'],
                    'Jumlah' => $item['Jumlah'],
                ]);
            }

            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Transaksi berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan data: ' . $e->getMessage()]);
        }
    }

    public function print($noFaktur)
    {
        $penjualan = Penjualan::with(['customer', 'details.barang'])->findOrFail($noFaktur);
        return view('penjualan.print', compact('penjualan'));
    }

    public function csv($noFaktur)
    {
        $penjualan = Penjualan::with(['customer', 'details.barang'])->findOrFail($noFaktur);

        $filename = 'penjualan_' . $penjualan->No_Faktur . '.csv';
        $headers = ['Content-Type' => 'text/csv'];

        $callback = function () use ($penjualan) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Kode', 'Nama Barang', 'Harga', 'Qty', 'Diskon', 'Bruto', 'Jumlah']);

            foreach ($penjualan->details as $item) {
                fputcsv($file, [
                    $item->Kode_Barang,
                    $item->barang->Nama_Barang ?? '-',
                    $item->Harga,
                    $item->Qty,
                    $item->Diskon,
                    $item->Bruto,
                    $item->Jumlah,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, array_merge($headers, [
            'Content-Disposition' => "attachment; filename=\"$filename\""
        ]));
    }
}
