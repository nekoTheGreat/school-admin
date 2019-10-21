<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeacherSubject extends Model
{
    protected $table = 'teacher_subjects';
    protected $fillable = ['teacher_id', 'subject_id'];
    public $timestamps = false;
}
