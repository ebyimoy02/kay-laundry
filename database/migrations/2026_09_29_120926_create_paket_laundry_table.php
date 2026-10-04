<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket_laundry', function (Blueprint $table) {
            $table->increments('id_paket');
            $table->string('nama_paket', 100);
            $table->decimal('harga', 12, 2);
            $table->string('satuan', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket_laundry');
    }
};