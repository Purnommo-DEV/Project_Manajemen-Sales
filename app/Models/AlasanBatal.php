<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlasanBatal extends Model
{
    use HasFactory;
    protected $table = "alasan_batal";
    protected $guarded = ['id'];
}
