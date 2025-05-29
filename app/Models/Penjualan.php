<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 't_jual';
    protected $primaryKey = 'No_Faktur';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'No_Faktur',
        'Kode_Customer',
        'Kode_Tjen',
        'Tgl_Faktur',
        'Total_Bruto',
        'Total_Diskon',
        'Total_Jumlah',
        'Total_Netto',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Kode_Customer', 'Kode_Customer');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisTransaksi::class, 'Kode_Tjen', 'Kode_Tjen');
    }

    public function details()
    {
        return $this->hasMany(Djual::class, 'No_Faktur', 'No_Faktur');
    }

}
