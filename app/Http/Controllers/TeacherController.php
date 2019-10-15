<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Teacher;
use App\Models\User;
use App\SafeObject;
use App\DT;

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
			->paginate(20, '*', 'page', $page);

		$records = [];
		foreach($collection as $item){
			$records[] = $item;
		}

		$tpl = $this->getTpl('teachers/index');

		return view($tpl, ['items'=> $records]);
	}

	public function newForm(Request $request)
	{
		$tpl = $this->getTpl('teachers/new-form');
		$form = new SafeObject([
			'password'=> uniqid()
		]);
		$tpl_data = [
			'form_legend'=> 'Create new teacher',
			'form_action'=> 'create',
			'form'=> $form
		];
		return view($tpl, $tpl_data);
	}

	public function updateForm(Request $request, $teacher_id)
	{
		$columns = [
			'teachers.*', 'users.firstname', 'users.lastname', 'users.middlename',
			'users.type', 'users.email', 'users.password'
		];
		$item = Teacher::
			select($columns)
			->join('users', function($join){
				$join->on('teachers.user_id', '=', 'users.id');
			})->where('teachers.id', '=', $teacher_id)->first();
		
		$item = $item->toArray();
		$tpl_data = [
			'form'=> new SafeObject($item),
			'form_name'=> 'index',
			'form_legend'=> 'Update Teacher',
			'form_action'=> 'update',
			'page_title'=> 'Update Teacher'
		];

		$tpl = $this->getTpl('teachers/update-form');
		
		return view($tpl, $tpl_data);
	}

	public function create(Request $request)
	{
		$data = $request->all();
		$data['type'] = 'teacher';
		$data['created_at'] = DT::utc();
		$data['password'] = bcrypt($data['password']);
		
		$user = User::create($data);
		if(empty($user)){
			throw new \Exception("User failed to create");
		}
		$teacher = new Teacher();
		$teacher->user_id = $user->id;
		$teacher->rank = $data['rank'];
		$teacher->save();

		return redirect()->action("\\".self::class."@index");
	}

	public function update(Request $request, $teacher_id)
	{
		$data = $request->all();
		$data['updated_at'] = DT::utc();
		
		$teacher = Teacher::find($teacher_id);
		if(empty($teacher)){
			throw new \Exception("User not a teacher");
		}
		$teacher->rank = $data['rank'];
		$teacher->save();

		$user = User::find($teacher['user_id']);
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

		return redirect()->action("\\".self::class."@updateForm", ['teacher_id'=>$teacher_id]);
	}

	public function deleteForm(Request $request, $teacher_id)
	{
		$columns = [
			'teachers.*', 'users.firstname', 'users.lastname', 'users.middlename',
			'users.type', 'users.email', 'users.password'
		];
		$item = Teacher::
			select($columns)
			->join('users', function($join){
				$join->on('teachers.user_id', '=', 'users.id');
			})->where('teachers.id', '=', $teacher_id)->first();
		
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('teachers/delete-form');
		$tpl_data = [
			'form_legend'=> 'Confirm delete teacher',
			'form_action'=> 'delete',
			'form'=> $form
		];
		return view($tpl, $tpl_data);
	}

	public function delete(Request $request, $teacher_id)
	{
		$teacher = Teacher::find($teacher_id);
		if(empty($teacher)){
			throw new \Exception("Teacher not found");
		}
		$teacher->forceDelete();

		$user = User::find($teacher->user_id);
		if(empty($user)){
			throw new \Exception("User not found");
		}
		
		$user->forceDelete();

		return redirect()->action("\\".self::class."@index");
	}

	public function listSubjects(Request $request, $teacher_id)
	{
		$columns = [
			'teachers.*', 'users.firstname', 'users.lastname', 'users.middlename',
			'users.type', 'users.email', 'users.password'
		];
		$item = Teacher::
			select($columns)
			->join('users', function($join){
				$join->on('teachers.user_id', '=', 'users.id');
			})->where('teachers.id', '=', $teacher_id)->first();
		
		$item = $item->toArray();
		$tpl_data = [
			'form'=> new SafeObject($item),
			'subjects'=> [],
			'form_name'=> 'subjects',
			'form_sub_name'=> 'index',
			'page_title'=> 'List of subjects'
		];

		$tpl = $this->getTpl('teachers/update-form');
		
		return view($tpl, $tpl_data);
	}

	public function attachSubjectsForm(Request $request, $teacher_id)
	{
		$columns = [
			'teachers.*', 'users.firstname', 'users.lastname', 'users.middlename',
			'users.type', 'users.email', 'users.password'
		];
		$item = Teacher::
			select($columns)
			->join('users', function($join){
				$join->on('teachers.user_id', '=', 'users.id');
			})->where('teachers.id', '=', $teacher_id)->first();
		
		$item = $item->toArray();
		$tpl_data = [
			'form'=> new SafeObject($item),
			'form_name'=> 'subjects',
			'form_sub_name'=> 'create',
			'page_title'=> 'New Subject for Teacher'
		];

		$tpl = $this->getTpl('teachers/update-form');
		
		return view($tpl, $tpl_data);
	}
}
