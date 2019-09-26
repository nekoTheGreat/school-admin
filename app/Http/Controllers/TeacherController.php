<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Teacher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->get('page');

        $collection = Teacher::
            select('teachers.*', 'users.firstname', 'users.lastname')
            ->leftJoin('users', function($join){
                $join->on('teachers.user_id', '=', 'users.id');
            })
            ->paginate(1, '*', 'page', 2);
            //->get();
        $records = [];
        foreach($collection as $item){
            $records[] = $item;
        }

        $tpl = $this->getTpl('teachers/index');

        return view($tpl, ['items'=> $records]);
    }
}
