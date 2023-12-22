<?php

namespace App\Models;

// use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    // use Uuids;
    use HasFactory;
    protected $table = "produk";
    protected $guarded = ['id'];
}
