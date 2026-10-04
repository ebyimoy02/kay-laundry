<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Admin extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
    ];

    public function transaksi(): HasMany
    {
        return $this->hasMany(Transaksi::class, 'id_admin', 'id_admin');
    }
}