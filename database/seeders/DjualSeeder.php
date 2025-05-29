<?php

namespace Database\Seeders;

use App\Models\Djual;
use Illuminate\Database\Seeder;

class DjualSeeder extends Seeder
{
    public function run(): void
    {
        Djual::insert([
            [
                'No_Faktur' => 'F001',
                'Kode_Barang' => 'BRG001',
                'Harga' => 10000,
                'Qty' => 2,
                'Diskon' => 10, // 10% diskon
                'Bruto' => 20000, // Harga x Qty
                'Jumlah' => 18000, // Bruto - (10% dari 20000)
            ],
            [
                'No_Faktur' => 'F001',
                'Kode_Barang' => 'BRG002',
                'Harga' => 15000,
                'Qty' => 1,
                'Diskon' => 5, // 5% diskon
                'Bruto' => 15000,
                'Jumlah' => 14250, // 15000 - (5% dari 15000)
            ]
        ]);
    }
}

