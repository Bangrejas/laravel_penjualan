<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    // Ambil data barang berdasarkan kode (untuk autofill)
    public function show($kode)
    {
        $barang = Barang::where('Kode_Barang', $kode)->first();

        if (!$barang) {
            return response()->json(['error' => 'Barang tidak ditemukan'], 404);
        }

        return response()->json([
            'Kode_Barang' => $barang->Kode_Barang,
            'Nama_Barang' => $barang->Nama_Barang,
            'Harga_Barang' => $barang->Harga_Barang,
        ]);
    }

    // Pencarian barang (untuk autocomplete)
    public function search(Request $request)
    {
        $term = $request->q;

        $data = Barang::where('Kode_Barang', 'like', "%$term%")
            ->orWhere('Nama_Barang', 'like', "%$term%")
            ->get()
            ->map(function ($item) {
                return [
                    'label' => $item->Kode_Barang . ' - ' . $item->Nama_Barang,
                    'value' => $item->Kode_Barang,
                    'nama'  => $item->Nama_Barang,
                    'harga' => $item->Harga_Barang,
                ];
            })
            ->values() // urutkan ulang index
            ->all();   // konversi ke array biasa (BUKAN Collection)

        return response()->json($data);
    }


}
