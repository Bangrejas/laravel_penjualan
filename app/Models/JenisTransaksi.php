<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisTransaksi extends Model
{
    protected $table = 't_jenis_transaksi'; // <- WAJIB ditulis manual
    protected $primaryKey = 'Kode_Tjen';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['Kode_Tjen', 'Nama_Tjen'];
}
