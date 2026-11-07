<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            ALTER TABLE `transaksi`
            MODIFY `status_pembayaran`
            ENUM('Lunas', 'Belum Lunas', 'Belum Bayar')
            NOT NULL DEFAULT 'Belum Bayar'
            AFTER `total`
        ");

        DB::table('transaksi')
            ->where('status_pembayaran', 'Belum Lunas')
            ->update(['status_pembayaran' => 'Belum Bayar']);

        DB::statement("
            ALTER TABLE `transaksi`
            MODIFY `status_pembayaran`
            ENUM('Lunas', 'Belum Bayar')
            NOT NULL DEFAULT 'Belum Bayar'
            AFTER `total`
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("
            ALTER TABLE `transaksi`
            MODIFY `status_pembayaran`
            ENUM('Lunas', 'Belum Bayar', 'Belum Lunas')
            NOT NULL DEFAULT 'Belum Lunas'
            AFTER `total`
        ");

        DB::table('transaksi')
            ->where('status_pembayaran', 'Belum Bayar')
            ->update(['status_pembayaran' => 'Belum Lunas']);

        DB::statement("
            ALTER TABLE `transaksi`
            MODIFY `status_pembayaran`
            ENUM('Lunas', 'Belum Lunas')
            NOT NULL DEFAULT 'Belum Lunas'
            AFTER `total`
        ");
    }
};