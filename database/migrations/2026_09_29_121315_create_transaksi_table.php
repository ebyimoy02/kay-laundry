<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id_transaksi');

            $table->unsignedInteger('id_admin');
            $table->unsignedInteger('id_pelanggan');

            $table->date('tgl_masuk');
            $table->date('tgl_selesai')->nullable();

            $table->decimal('total', 12, 2);

            $table->foreign('id_admin')
                ->references('id_admin')
                ->on('admin')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggan')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};