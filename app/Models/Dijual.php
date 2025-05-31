<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dijual extends Model
{
    /** @use HasFactory<\Database\Factories\DijualFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    // relasi dengan model jualan
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'no_faktur', 'no_faktur');
    }

    // relasi dengan model barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'kode_barang', 'id');
    }
}
