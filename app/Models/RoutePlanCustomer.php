<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutePlanCustomer extends Model
{
    use HasFactory;
    protected $table = "route_plan_customer";
    protected $guarded = ["id"];

    public function relasi_route_plan()
    {
        return $this->belongsTo(RoutePlan::class, 'id_route_plan', 'id');
    }

    public function relasi_customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }
}
