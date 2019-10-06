<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = [
        'firstname', 'lastname', 'middlename', 'type', 'email',
        'password', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
