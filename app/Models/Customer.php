<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    // relasi dengan model penjualan
    public function penjualan()
    {
        return $this->hasMany(Penjualan::class, 'kode_customer', 'kode_customer');
    }
}
