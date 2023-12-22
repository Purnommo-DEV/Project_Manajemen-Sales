<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoutePlanTemp extends Model
{
    use HasFactory;
    protected $table = "route_plan_temp";
    protected $guarded = ["id"];

    public function relasi_sales()
    {
        return $this->belongsTo(User::class, 'id_sales', 'id');
    }
}
