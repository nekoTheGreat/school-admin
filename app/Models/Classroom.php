<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Classroom extends Model
{
    protected $table = 'classrooms';
    protected $fillable = [
        'name', 'created_at', 'created_by', 'updated_at',
        'updated_by'
    ];
    public $timestamps = false;
}
