<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = "kategoris";

    protected $dates = ['deleted_at'];

    protected $fillable = ['nama', 'jenis'];

    protected $appends = ['jenis_label'];

    public function getJenisLabelAttribute()
    {
        if ($this->jenis == "pengeluaran") {
            return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                  Pengeluaran
                </span>';
        }
        return '<span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                  Pemasukan
                </span>';
    }

    public function transaksi()
    {
        return $this->hasOne('App\Models\Transaksi');
    }
}
