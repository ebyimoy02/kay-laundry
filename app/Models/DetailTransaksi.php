<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DetailTransaksi extends Model
{
    protected $table = 'detail_transaksi';

    protected $primaryKey = 'id_detail';

    public $timestamps = false;

    protected $fillable = [
        'id_transaksi',
        'id_paket',
        'berat',
        'harga',
        'subtotal',
    ];

    protected $casts = [
        'berat' => 'decimal:2',
        'harga' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(
            Transaksi::class,
            'id_transaksi',
            'id_transaksi'
        );
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(
            PaketLaundry::class,
            'id_paket',
            'id_paket'
        );
    }
}