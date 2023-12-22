<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerHutang extends Model
{
    use HasFactory;
    protected $table = "rute_temp";
    protected $guarded = ["id"];


    public function relasi_customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
