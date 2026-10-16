<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_pelanggan');
            $table->date('tgl_masuk');
            $table->date('tgl_selesai')->nullable();
            $table->decimal('total', 12, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};