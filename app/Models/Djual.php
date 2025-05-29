<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Djual extends Model
{
    protected $table = 't_djual';
    
    public $timestamps = false;

    protected $fillable = [
        'No_Faktur',
        'Kode_Barang',
        'Harga',
        'Qty',
        'Diskon',
        'Bruto',
        'Jumlah',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'Kode_Barang', 'Kode_Barang');
    }
    
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'No_Faktur', 'No_Faktur');
    }
}

