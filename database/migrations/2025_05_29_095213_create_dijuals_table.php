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
        Schema::create('dijuals', function (Blueprint $table) {
            $table->id();
            $table->float('harga', 15, 2);
            $table->float('quantity', 15, 2)->default(0);
            $table->float('diskon', 15, 2)->default(0);
            $table->float('brutto', 15, 2)->default(0);
            $table->float('jumlah', 15, 2)->default(0);

            // relasi
            $table->foreignId('kode_barang');
            $table->foreignId('no_faktur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dijuals');
    }
};
