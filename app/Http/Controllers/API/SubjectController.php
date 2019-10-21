<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\SafeObject;
use App\DT;

class SubjectController extends Controller
{
	public function search(Request $request)
	{
		$page = $request->get('page');
		if(empty($page)){
			$page = 1;
		}
		$per_page = 20;

		$collection = Subject::
			select(['id', 'name', 'category', 'education_stage_id'])
			->paginate(20, '*', 'page', $page);

		$records = [];
		foreach($collection as $item){
			$records[] = $item;
		}

		$tpl = $this->getTpl('subjects/index');
		$tpl_data = [
			'items'=> $records,
			'page'=> $page
		];

		return response()->json($tpl_data);
	}

	public function getTeacher(Request $request, $teacher_id)
	{
		$page = $request->get('page');
		if(empty($page)){
			$page = 1;
		}
		$per_page = 20;

		$columns = [
			'subjects.*'
		];
		$collection = Subject::
			select($columns)
			->join('teacher_subjects', function($join){
				$join->on('teacher_subjects.subject_id', '=', 'subjects.id');
			})
			->where('teacher_subjects.teacher_id', '=', $teacher_id)
			->paginate($per_page, '*', 'page', $page);
		
		$items = [];
		foreach($collection as $item){
			$items[] = $item;
		}

		$tpl = $this->getTpl('subjects/index');
		$tpl_data = [
			'items'=> $items,
			'page'=> $page
		];

		return response()->json($tpl_data);
	}
}
