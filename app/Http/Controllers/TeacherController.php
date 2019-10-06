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
			'form'=> $form
		];
		return view($tpl, $tpl_data);
	}

	public function saveForm(Request $request)
	{
		$data = $request->all();
		$data['type'] = 'teacher';
		if(isset($data['id']) && $id = $data['id']){
			unset($data['id']);
			$data['updated_at'] = DT::utc();
			$teacher = Teacher::find($id);
			if(empty($teacher)){
				throw new \Exception("User not a teacher");
			}
			$teacher->rank = $data['rank'];
			$teacher->save();

			$user = User::find($teacher['user_id']);
			if(empty($user)){
				throw new \Exception("User not found");
			}
			$user->fill($data);
			$user->save();
		}else{
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
		}

		return redirect()->action("\\".self::class."@index");
	}
}
