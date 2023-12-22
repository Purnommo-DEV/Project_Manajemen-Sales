<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjalanan extends Model
{
    use HasFactory;
    protected $table = "perjalanan";
    protected $guarded = ["id"];

    public function relasi_sales()
    {
        return $this->belongsTo(User::class, 'user_sales_id', 'id');
    }

    public function relasi_kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id');
    }
}
