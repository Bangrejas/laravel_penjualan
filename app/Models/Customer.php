<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 't_customer'; // 👈 ini penting!
    protected $primaryKey = 'Kode_Customer';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'Kode_Customer', 'Nama_Customer', 'Alamat', 'Kota', 'Telp'
    ];
}
