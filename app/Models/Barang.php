<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    /** @use HasFactory<\Database\Factories\BarangFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    // relasi dengan model dijual
    public function dijual()
    {
        return $this->hasMany(Dijual::class, 'kode_barang', 'kode_barang');
    }

    // relasi dengan model jenis
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'kode_jenis', 'kode_jenis');
    }
}
