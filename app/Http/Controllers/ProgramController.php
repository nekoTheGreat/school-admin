<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Program;

class ProgramController extends Controller
{
    protected $tpl_prefix = "programs.";

    public function index()
    {
        $records = Program::all();

        return view($this->tpl_prefix.'index', ['items'=> $records]);
    }
}
