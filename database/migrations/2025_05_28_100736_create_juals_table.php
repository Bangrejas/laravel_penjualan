<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJualsTable extends Migration
{
    public function up()
    {
        Schema::create('t_jual', function (Blueprint $table) {
            $table->char('No_Faktur', 6)->primary();
            $table->char('Kode_Customer', 4);
            $table->char('Kode_Tjen', 10);
            $table->date('Tgl_Faktur');
            $table->decimal('Total_Bruto', 15, 2)->default(0);
            $table->decimal('Total_Diskon', 15, 2)->default(0);
            $table->decimal('Total_Jumlah', 15, 2)->default(0);
            $table->integer('Total_Netto');

            // Foreign Key
            $table->foreign('Kode_Customer')->references('Kode_Customer')->on('t_customer');
            $table->foreign('Kode_Tjen')->references('Kode_Tjen')->on('t_jenis_transaksi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_jual');
    }
};
