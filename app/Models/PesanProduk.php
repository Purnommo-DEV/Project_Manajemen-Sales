<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanProduk extends Model
{
    use HasFactory;
    protected $table = "pesan_produk";
    protected $guarded = ["id"];

    public function relasi_perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'perusahaan_id', 'id');
    }
}
