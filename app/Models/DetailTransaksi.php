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

    public function transaksi(): BelongsTo
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function paketLaundry(): BelongsTo
    {
        return $this->belongsTo(PaketLaundry::class, 'id_paket', 'id_paket');
    }
}