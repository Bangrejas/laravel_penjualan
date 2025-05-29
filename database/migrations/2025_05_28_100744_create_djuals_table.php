<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDjualsTable extends Migration
{
    public function up()
    {
        Schema::create('t_djual', function (Blueprint $table) {
            $table->char('No_Faktur', 6);
            $table->char('Kode_Barang', 10);
            $table->decimal('Harga', 15, 2)->default(0);
            $table->decimal('Qty', 15, 2)->default(0);
            $table->decimal('Diskon', 15, 2)->default(0);
            $table->decimal('Bruto', 15, 2)->default(0);
            $table->decimal('Jumlah', 15, 2)->default(0);

            // Composite Primary Key
            $table->primary(['No_Faktur', 'Kode_Barang']);

            // Foreign Keys
            $table->foreign('No_Faktur')->references('No_Faktur')->on('t_jual')->onDelete('cascade');
            $table->foreign('Kode_Barang')->references('Kode_Barang')->on('t_barang');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_djual');
    }
};
