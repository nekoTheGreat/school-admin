<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\User;
use App\SafeObject;
use App\DT;

class StudentController extends Controller
{
	public function index(Request $request)
	{
		$page = $request->get('page');

		$collection = Student::
			select('students.*', 'users.firstname', 'users.lastname')
			->leftJoin('users', function($join){
				$join->on('students.user_id', '=', 'users.id');
			})
			->paginate(20, '*', 'page', $page);

		$records = [];
		foreach($collection as $item){
			$records[] = $item;
		}

		$tpl = $this->getTpl('students/index');

		return view($tpl, ['items'=> $records]);
	}

	public function newForm(Request $request)
	{
		$tpl = $this->getTpl('students/new-form');
		$form = new SafeObject([
			'password'=> uniqid()
		]);
		$tpl_data = [
			'form_legend'=> 'Create new student',
			'form_action'=> 'create',
			'form'=> $form
		];
		return view($tpl, $tpl_data);
	}

	public function updateForm(Request $request, $student_id)
	{
		$columns = [
			'students.*', 'users.firstname', 'users.lastname', 'users.middlename',
			'users.type', 'users.email', 'users.password'
		];
		$item = Student::
			select($columns)
			->join('users', function($join){
				$join->on('students.user_id', '=', 'users.id');
			})->where('students.id', '=', $student_id)->first();
		
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('students/update-form');
		$tpl_data = [
			'form_legend'=> 'Update student',
			'form_action'=> 'update',
			'form'=> $form
		];
		return view($tpl, $tpl_data);
	}

	public function create(Request $request)
	{
		$data = $request->all();
		$data['type'] = 'student';
		$data['created_at'] = DT::utc();
		$data['password'] = bcrypt($data['password']);
		
		$user = User::create($data);
		if(empty($user)){
			throw new \Exception("User failed to create");
		}
		$student = new Student();
		$student->user_id = $user->id;
		$student->grade_level = $data['grade_level'];
		$student->save();

		return redirect()->action("\\".self::class."@index");
	}

	public function update(Request $request, $student_id)
	{
		$data = $request->all();
		$data['updated_at'] = DT::utc();
		
		$student = Student::find($student_id);
		if(empty($student)){
			throw new \Exception("User not a student");
		}
		$student->grade_level = $data['grade_level'];
		$student->save();

		$user = User::find($student['user_id']);
		if(empty($user)){
			throw new \Exception("User not found");
		}
		if($data['password']){
			if($data['password'] != $data['confirm_password']){
				throw new \Exception("Password and confirm password are different");
			}
			$data['password'] = bcrypt($data['password']);
		}else{
			unset($data['password']);
		}
		$user->fill($data);
		$user->save();

		return redirect()->action("\\".self::class."@updateForm", ['student_id'=>$student_id]);
	}

	public function deleteForm(Request $request, $student_id)
	{
		$columns = [
			'students.*', 'users.firstname', 'users.lastname', 'users.middlename',
			'users.type', 'users.email', 'users.password'
		];
		$item = Student::
			select($columns)
			->join('users', function($join){
				$join->on('students.user_id', '=', 'users.id');
			})->where('students.id', '=', $student_id)->first();
		
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('students/delete-form');
		$tpl_data = [
			'form_legend'=> 'Confirm delete student',
			'form_action'=> 'delete',
			'form'=> $form
		];
		return view($tpl, $tpl_data);
	}

	public function delete(Request $request, $student_id)
	{
		$student = Student::find($student_id);
		if(empty($student)){
			throw new \Exception("Student not found");
		}
		$student->forceDelete();

		$user = User::find($student->user_id);
		if(empty($user)){
			throw new \Exception("User not found");
		}
		
		$user->forceDelete();

		return redirect()->action("\\".self::class."@index");
	}
}
