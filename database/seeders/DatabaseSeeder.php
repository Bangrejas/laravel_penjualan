<?php

namespace Database\Seeders;

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
            'nama_jenis' => 'Elektronik',
        ]);
        Jenis::factory()->create([
            'kode_jenis' => '002',
            'nama_jenis' => 'Pakaian',
        ]);
        Jenis::factory()->create([
            'kode_jenis' => '003',
            'nama_jenis' => 'Makanan',
        ]);
    }
}
