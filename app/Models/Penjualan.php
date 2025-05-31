<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    /** @use HasFactory<\Database\Factories\PenjualanFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    // relasi dengan model dijual
    public function dijual()
    {
        return $this->hasMany(Dijual::class, 'no_faktur', 'no_faktur');
    }

    // relasi dengan model jenis
    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'kode_jenis', 'id');
    }

    // relasi dengan model customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'kode_customer', 'id');
    }
}
