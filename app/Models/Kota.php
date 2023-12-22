<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;
    protected $table = "indonesia_cities";
    protected $guarded = ['id'];

    public function relasi_provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'province_code', 'id');
    }
}
