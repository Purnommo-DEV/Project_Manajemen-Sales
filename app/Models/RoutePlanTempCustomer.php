<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutePlanTempCustomer extends Model
{
    use HasFactory;
    protected $table = "route_plan_temp_customer";
    protected $guarded = ["id"];

    public function relasi_route_plan_temp()
    {
        return $this->belongsTo(RoutePlanTemp::class, 'id_route_plan_temp', 'id');
    }
    public function relasi_customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }
}
