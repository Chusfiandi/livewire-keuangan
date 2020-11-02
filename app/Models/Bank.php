<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "banks";
    protected $dates = ['deleted_at'];

    protected $fillable = ['nama', 'pemilik', 'nomor', 'saldo'];

    public function transaksi()
    {
        return $this->hasOne('App\Models\Transaksi');
    }
}
