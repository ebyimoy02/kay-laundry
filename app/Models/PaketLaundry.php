<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketLaundry extends Model
{
    protected $table = 'paket_laundry';

    protected $primaryKey = 'id_paket';

    public $timestamps = false;

    protected $fillable = [
        'nama_paket',
        'harga',
        'satuan',
    ];

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(
            DetailTransaksi::class,
            'id_paket',
            'id_paket'
        );
    }
}