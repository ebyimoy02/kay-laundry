<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->increments('id_detail');

            $table->unsignedInteger('id_transaksi');
            $table->unsignedInteger('id_paket');

            $table->decimal('berat', 8, 2);
            $table->decimal('harga', 12, 2);
            $table->decimal('subtotal', 12, 2);

            $table->foreign('id_transaksi')
                ->references('id_transaksi')
                ->on('transaksi')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('id_paket')
                ->references('id_paket')
                ->on('paket_laundry')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};