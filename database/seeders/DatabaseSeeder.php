<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\Jenis;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
        ]);

        Jenis::factory()->create([
            'kode_jenis' => '001',
            'nama_jenis' => 'Kirim',
        ]);
        Jenis::factory()->create([
            'kode_jenis' => '002',
            'nama_jenis' => 'Terima',
        ]);
        Jenis::factory()->create([
            'kode_jenis' => '003',
            'nama_jenis' => 'Kirim & Terima',
        ]);

        Customer::factory()->create([
            'kode_customer' => '1',
            'nama_customer' => 'Customer A',
        ]);

        Barang::factory()->create([
            'kode_barang' => '1',
            'nama_barang' => 'Barang A',
            'harga_barang' => '10000',
        ]);

        Barang::factory()->create([
            'kode_barang' => '2',
            'nama_barang' => 'Barang B',
            'harga_barang' => '20000',
        ]);
    }
}
