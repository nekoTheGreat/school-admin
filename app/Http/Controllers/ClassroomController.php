<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Classroom;
use App\SafeObject;
use App\DT;

class ClassroomController extends Controller
{
	public function index(Request $request)
	{
		$page = $request->get('page');

		$collection = Classroom::
			select('*')
			->paginate(20, '*', 'page', $page);

		$records = [];
		foreach($collection as $item){
			$records[] = $item;
		}

		$tpl = $this->getTpl('classrooms/index');
		$tpl_data = [
			'items'=> $records,
			'page_title'=> 'List of classrooms'
		];

		return view($tpl, $tpl_data);
	}

	public function newForm(Request $request)
	{
		$tpl = $this->getTpl('classrooms/new-form');
		$form = new SafeObject([
			'password'=> uniqid()
		]);
		$tpl_data = [
			'form_legend'=> 'Create new classroom',
			'form_action'=> 'create',
			'form'=> $form,
			'page_title'=> 'New Classroom'
		];
		return view($tpl, $tpl_data);
	}

	public function updateForm(Request $request, $classroom_id)
	{
		$item = Classroom::select('*')->where('classrooms.id', '=', $classroom_id)->first();
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('classrooms/update-form');
		$tpl_data = [
			'form_legend'=> 'Update classroom',
			'form_action'=> 'update',
			'form'=> $form,
			'page_title'=> 'Update Classroom'
		];
		return view($tpl, $tpl_data);
	}

	public function create(Request $request)
	{
		$data = $request->all();
		$data['created_at'] = DT::utc();
		$data['created_by'] = 'System';
		
		$classroom = new Classroom();
		$classroom->fill($data);
		$classroom->save();

		return redirect()->action("\\".self::class."@index");
	}

	public function update(Request $request, $classroom_id)
	{
		$data = $request->all();
		$data['updated_at'] = DT::utc();
		$data['updated_by'] = 'System';
		
		$classroom = Classroom::find($classroom_id);
		if(empty($classroom)){
			throw new \Exception("User not a classroom");
		}
		$classroom->name = $data['name'];
		$classroom->save();

		return redirect()->action("\\".self::class."@updateForm", ['classroom_id'=>$classroom_id]);
	}

	public function deleteForm(Request $request, $classroom_id)
	{
		$item = Classroom::find($classroom_id);
		if(empty($item)){
			throw new \Exception("User not a classroom");
		}
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('classrooms/delete-form');
		$tpl_data = [
			'form_legend'=> 'Confirm delete classroom',
			'form_action'=> 'delete',
			'form'=> $form,
			'page_title'=> 'Delete classroom'
		];
		
		return view($tpl, $tpl_data);
	}

	public function delete(Request $request, $classroom_id)
	{
		$classroom = Classroom::find($classroom_id);
		if(empty($classroom)){
			throw new \Exception("Classroom not found");
		}
		$classroom->forceDelete();

		return redirect()->action("\\".self::class."@index");
	}
}
