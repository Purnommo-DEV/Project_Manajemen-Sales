<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSurvey extends Model
{
    use HasFactory;
    protected $table = "form_survey";
    protected $guarded = ['id'];
}
