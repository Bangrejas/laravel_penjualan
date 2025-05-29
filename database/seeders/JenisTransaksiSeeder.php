<?php

namespace Database\Seeders;

use App\Models\JenisTransaksi;
use Illuminate\Database\Seeder;

class JenisTransaksiSeeder extends Seeder
{
    public function run(): void
    {
        JenisTransaksi::insert([
            ['Kode_Tjen' => 'J01', 'Nama_Tjen' => 'Tunai'],
            ['Kode_Tjen' => 'J02', 'Nama_Tjen' => 'Kredit'],
        ]);
    }
}

