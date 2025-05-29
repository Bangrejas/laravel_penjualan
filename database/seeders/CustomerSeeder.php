<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::insert([
            ['Kode_Customer' => 'C001', 'Nama_Customer' => 'PT Maju Jaya'],
            ['Kode_Customer' => 'C002', 'Nama_Customer' => 'CV Sumber Rejeki'],
        ]);
    }
}

