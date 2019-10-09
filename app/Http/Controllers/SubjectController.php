<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\Subject;
use App\SafeObject;
use App\DT;

class SubjectController extends Controller
{
	public function index(Request $request)
	{
		$page = $request->get('page');

		$collection = Subject::
			select('*')
			->paginate(20, '*', 'page', $page);

		$records = [];
		foreach($collection as $item){
			$records[] = $item;
		}

		$tpl = $this->getTpl('subjects/index');
		$tpl_data = [
			'items'=> $records,
			'page_title'=> 'List of subjects'
		];

		return view($tpl, $tpl_data);
	}

	public function newForm(Request $request)
	{
		$tpl = $this->getTpl('subjects/new-form');
		$form = new SafeObject([
			'password'=> uniqid()
		]);
		$tpl_data = [
			'form_legend'=> 'Create new subject',
			'form_action'=> 'create',
			'form'=> $form,
			'page_title'=> 'New Subject'
		];
		return view($tpl, $tpl_data);
	}

	public function updateForm(Request $request, $subject_id)
	{
		$item = Subject::select('*')->where('subjects.id', '=', $subject_id)->first();
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('subjects/update-form');
		$tpl_data = [
			'form_legend'=> 'Update subject',
			'form_action'=> 'update',
			'form'=> $form,
			'page_title'=> 'Update Subject'
		];
		return view($tpl, $tpl_data);
	}

	public function create(Request $request)
	{
		$data = $request->all();
		$data['created_at'] = DT::utc();
		$data['created_by'] = 'System';
		
		$subject = new Subject();
		$subject->fill($data);
		$subject->save();

		return redirect()->action("\\".self::class."@index");
	}

	public function update(Request $request, $subject_id)
	{
		$data = $request->all();
		$data['updated_at'] = DT::utc();
		$data['updated_by'] = 'System';
		
		$subject = Subject::find($subject_id);
		if(empty($subject)){
			throw new \Exception("User not a subject");
		}
		$subject->name = $data['name'];
		$subject->save();

		return redirect()->action("\\".self::class."@updateForm", ['subject_id'=>$subject_id]);
	}

	public function deleteForm(Request $request, $subject_id)
	{
		$item = Subject::find($subject_id);
		if(empty($item)){
			throw new \Exception("User not a subject");
		}
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('subjects/delete-form');
		$tpl_data = [
			'form_legend'=> 'Confirm delete subject',
			'form_action'=> 'delete',
			'form'=> $form,
			'page_title'=> 'Delete subject'
		];
		
		return view($tpl, $tpl_data);
	}

	public function delete(Request $request, $subject_id)
	{
		$subject = Subject::find($subject_id);
		if(empty($subject)){
			throw new \Exception("Subject not found");
		}
		$subject->forceDelete();

		return redirect()->action("\\".self::class."@index");
	}
}
