<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    /** @use HasFactory<\Database\Factories\JenisFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    // relasi dengan model penjualan
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'kode_jenis', 'kode_jenis');
    }
}
