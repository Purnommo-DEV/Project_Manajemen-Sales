<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokVisibility extends Model
{
    use HasFactory;
    protected $table = "stok_visibility";
    protected $guarded = ['id'];

    public function relasi_kondisi_pemajangan()
    {
        return $this->belongsTo(StatusKondisiPemajangan::class, 'kondisi_pemajangan_id', 'id');
    }


}
