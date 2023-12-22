<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = "area";
    protected $guarded = ['id'];

    public function relasi_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'provinsi_id', 'id');
    }

    public function relasi_kota()
    {
        return $this->belongsTo(Kota::class, 'kota_id', 'id');
    }

    public function relasi_kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
    }

    public function relasi_desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }
}
