<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
| OPSIONAL: pakai file ini HANYA jika tabel `paket` belum ada di database.
| Kalau tabelnya sudah ada (dibuat lewat phpMyAdmin / migration lain), jangan
| dijalankan; cukup sesuaikan nama tabel & kolom di app/Models/Paket.php.
*/
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paket', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nama_paket', 100);
            $table->unsignedInteger('harga');
            $table->string('satuan', 20)->default('Kg');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paket');
    }
};