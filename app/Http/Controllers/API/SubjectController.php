<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\SafeObject;
use App\DT;
use App\Models\TeacherSubject;

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
			'ts.id', 'subjects.id as subject_id', 'subjects.name', 'subjects.category',
			'subjects.education_stage_id'
		];
		$collection = Subject::
			select($columns)
			->join('teacher_subjects as ts', function($join){
				$join->on('ts.subject_id', '=', 'subjects.id');
			})
			->where('ts.teacher_id', '=', $teacher_id)
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

	public function saveTeacher(Request $request, $teacher_id)
	{
		$subjects = $request->input('subjects');
		if(is_array($subjects)){
			foreach($subjects as $subject){
				if(isset($subject['deleted'])){
					$ts = TeacherSubject::find($subject['id']);
					if($ts){
						$ts->destroy($subject['id']);
					}
				}else if(isset($subject['subject_id'])){
					$ts = new TeacherSubject();
					$ts->teacher_id = $teacher_id;
					$ts->subject_id = $subject['subject_id'];
					$ts->save();
				}
			}
		}

		return response()->json();
	}
}
