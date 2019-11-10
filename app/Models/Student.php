<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = ['user_id', 'education_stage_id', 'classroom_id'];
    public $timestamps = false;
}
