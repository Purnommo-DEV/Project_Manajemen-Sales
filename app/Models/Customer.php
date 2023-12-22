<?php

namespace App\Models;

// use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    // use Uuids;
    use HasFactory;
    protected $table = "customer";
    protected $guarded = ['id'];
}
