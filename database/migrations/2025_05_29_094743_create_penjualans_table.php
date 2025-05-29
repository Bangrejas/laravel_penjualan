<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->id();
            $table->string('no_faktur')->unique();
            $table->date('tanggal_faktur');
            $table->float('total_brutto', 15, 2);
            $table->float('total_diskon', 15, 2)->default(0);
            $table->float('total_jumlah', 15, 2);

            // relasi
            $table->foreignId('kode_customer');
            $table->foreignId('kode_jenis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penjualans');
    }
};
