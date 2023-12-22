<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanKeuangan extends Model
{
     use HasFactory;
     protected $table = "catatan_keuangan";
     protected $guarded = ['id'];

     public function relasi_jenis_transaksi(){
        return $this->belongsTo(JenisTransaksi::class, 'jenis_id', 'id');
     }

     public function relasi_kategori_transaksi(){
        return $this->belongsTo(KategoriCatatanKeuangan::class, 'kategori_id', 'id');
     }
}
