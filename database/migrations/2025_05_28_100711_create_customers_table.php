<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('t_customer', function (Blueprint $table) {
            $table->char('Kode_Customer', 4)->primary();
            $table->string('Nama_Customer', 40);
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_customer');
    }
};

