<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Dijual;
use App\Models\Jenis;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('penjualan.index', [
            'penjualans' => Penjualan::with(['dijual.barang', 'customer', 'jenis'])->latest()->get(),
            'customers' => Customer::all(),
            'barangs' => Barang::latest()->get(),
            'jenis' => Jenis::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('penjualan.create', [
        //     'jenis' => Jenis::all(),
        //     'customers' => Customer::all(),
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $penjualan = Penjualan::create([
                'no_faktur' => $request->no_faktur,
                'tanggal_faktur' => $request->tgl_faktur,
                'total_brutto' => $request->total_bruto,
                'total_diskon' => $request->total_diskon,
                'total_jumlah' => $request->total_jumlah,
                'kode_customer' => $request->kode_customer,
                'kode_jenis' => $request->kode_jenis,
            ]);

            foreach ($request->kode_barang as $i => $kodeBarang) {
                Dijual::create([
                    'no_faktur' => $penjualan->no_faktur,
                    'kode_barang' => $kodeBarang,
                    'harga' => $request->harga[$i] ?? 0,
                    'quantity' => $request->qty[$i] ?? 0,
                    'diskon' => $request->diskon[$i] ?? 0,
                    'brutto' => $request->bruto[$i] ?? 0,
                    'jumlah' => $request->jumlah[$i] ?? 0,
                ]);
            }

            // dd($penjualan);
            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Error storing penjualan: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e,
            ]);
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load(['dijual.barang', 'customer', 'jenis']); // gunakan `load()` di object

        return view('penjualan.show', [
            'penjualan' => $penjualan,
        ]);
    }

    /**
     * Print the specified resource.
     */
    public function print(Penjualan $penjualan)
    {
        $penjualan->load(['dijual.barang', 'customer', 'jenis']); // gunakan `load()` di object

        return view('penjualan.print', [
            'penjualan' => $penjualan,
        ]);
    }

    public function export(Penjualan $penjualan)
    {
        $penjualan->load(['dijual.barang', 'customer', 'jenis']);

        $filename = 'faktur_' . $penjualan->no_faktur . '.csv';

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Barang', 'Harga', 'Qty', 'Diskon', 'Jumlah'];

        $callback = function () use ($penjualan, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['No Faktur:', $penjualan->no_faktur]);
            fputcsv($file, ['Tanggal:', $penjualan->tanggal_faktur]);
            fputcsv($file, ['Customer:', $penjualan->customer->nama_customer]);
            fputcsv($file, ['Jenis:', $penjualan->jenis->nama_jenis]);
            fputcsv($file, []); // kosong
            fputcsv($file, $columns);

            foreach ($penjualan->dijual as $item) {
                fputcsv($file, [
                    $item->barang->nama_barang,
                    $item->harga,
                    $item->quantity,
                    $item->diskon,
                    $item->jumlah,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePenjualanRequest $request, Penjualan $penjualan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        DB::beginTransaction();

        try {
            // Hapus semua data dijual yang berkaitan dengan no_faktur ini
            Dijual::where('no_faktur', $penjualan->no_faktur)->delete();

            // Hapus penjualan utama
            $penjualan->delete();

            DB::commit();

            return redirect()->route('penjualan.index')->with('success', 'Faktur berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Gagal menghapus penjualan: ' . $e->getMessage(), [
                'penjualan_id' => $penjualan->id,
            ]);
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus faktur.']);
        }
    }
}
