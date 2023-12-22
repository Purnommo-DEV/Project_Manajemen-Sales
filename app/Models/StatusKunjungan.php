<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusKunjungan extends Model
{
    use HasFactory;
    protected $table = "status_kunjungan";
    protected $guarded = ['id'];

}
