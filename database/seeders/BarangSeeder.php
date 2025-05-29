<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        Barang::insert([
            ['Kode_Barang' => 'BRG001', 'Nama_Barang' => 'Pulpen Pilot', 'Harga_Barang' => 5000],
            ['Kode_Barang' => 'BRG002', 'Nama_Barang' => 'Buku Tulis', 'Harga_Barang' => 10000],
        ]);
    }
}

