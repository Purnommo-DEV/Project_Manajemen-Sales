<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesanProdukDetail extends Model
{
    use HasFactory;
    protected $table = "pesan_produk_detail";
    protected $guarded = ["id"];

    public function relasi_pesan_produk()
    {
        return $this->belongsTo(PesanProduk::class, 'pesan_produk_id', 'id');
    }

    public function relasi_produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
