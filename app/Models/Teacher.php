<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $fillable = ['user_id', 'rank'];
    public $timestamps = false;
}
