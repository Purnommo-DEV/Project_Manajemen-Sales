<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailInsentif extends Model
{
    use HasFactory;
    protected $table = "detail_insentif";
    protected $guarded = ['id'];

    public function relasi_bppbm(){
        return $this->belongsTo(BPPBM::class, 'bppbm_id', 'id');
    }

    public function relasi_customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
