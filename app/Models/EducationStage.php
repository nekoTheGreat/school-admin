<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EducationStage extends Model
{
    protected $table = 'education_stages';
    protected $fillable = [
        'stage', 'level', 'created_at', 'created_by'
    ];
    public $timestamps = false;
}
