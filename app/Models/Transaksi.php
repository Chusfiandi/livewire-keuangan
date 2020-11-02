<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = "transaksis";

    protected $fillable = ['tanggal', 'kategori_id', 'jenis', 'keterangan', 'nominal', 'bank_id'];

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

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

    public function kategori()
    {
        return $this->belongsTo('App\Models\Kategori');
    }
}
