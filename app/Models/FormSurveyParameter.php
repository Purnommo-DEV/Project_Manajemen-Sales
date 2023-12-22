<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSurveyParameter extends Model
{
    use HasFactory;
    protected $table = "form_survey_parameter";
    protected $guarded = ['id'];
}
