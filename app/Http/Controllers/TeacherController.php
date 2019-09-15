<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Teacher;
use Illuminate\Support\Facades\Config;

class TeacherController extends Controller
{
    public function index()
    {
        $records = Teacher::all();

        $tpl = $this->getTpl('teachers/index');

        return view($tpl, ['items'=> $records]);
    }
}
