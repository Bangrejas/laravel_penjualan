<?php

namespace Database\Seeders;

use App\Models\Penjualan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('t_jual')->insert([
            'No_Faktur' => 'F001',
            'Tgl_Faktur' => '2025-05-28',
            'Kode_Customer' => 'C001',
            'Kode_Tjen' => 'J01',
            'Total_Bruto' => 45000,
            'Total_Diskon' => 3000,
            'Total_Netto' => 42000,
        ]);
    }
}

