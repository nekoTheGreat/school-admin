<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    protected $table = 'subjects';
    protected $fillable = [
        'name', 'created_at', 'created_by', 'updated_at',
        'updated_by'
    ];
    public $timestamps = false;
}
