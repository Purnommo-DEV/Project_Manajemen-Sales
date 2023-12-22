<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPPBMStatus extends Model
{
    use HasFactory;
    protected $table = "bppbm_status";
    protected $guarded = ["id"];
}
