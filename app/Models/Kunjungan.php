<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = "kunjungan";
    protected $guarded = ['id'];

    public function relasi_route_plan()
    {
        return $this->belongsTo(Rute::class, 'id_rute', 'id');
    }

    public function relasi_customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    public function relasi_status_kunjungan()
    {
        return $this->belongsTo(StatusKunjungan::class, 'id_status_kunjungan', 'id');
    }

    public function relasi_alasan_batal()
    {
        return $this->belongsTo(AlasanBatal::class, 'id_alasan_batal', 'id');
    }
}
