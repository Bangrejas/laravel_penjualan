<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisTransaksisTable extends Migration
{
    public function up()
    {
        Schema::create('t_jenis_transaksi', function (Blueprint $table) {
            $table->char('Kode_Tjen', 10)->primary();
            $table->string('Nama_Tjen', 50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_jen');
    }
};