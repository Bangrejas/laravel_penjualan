<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    public function up()
    {
        Schema::create('t_barang', function (Blueprint $table) {
            $table->char('Kode_Barang', 10)->primary();
            $table->string('Nama_Barang', 20);
            $table->decimal('Harga_Barang', 15, 2);
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_barang');
    }
};
