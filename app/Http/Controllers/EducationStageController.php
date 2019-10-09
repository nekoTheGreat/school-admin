<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Models\EducationStage;
use App\SafeObject;
use App\DT;

class EducationStageController extends Controller
{
	public function index(Request $request)
	{
		$page = $request->get('page');

		$collection = EducationStage::
			select('*')
			->paginate(20, '*', 'page', $page);

		$records = [];
		foreach($collection as $item){
			$records[] = $item;
		}

		$tpl = $this->getTpl('education_stages/index');
		$tpl_data = [
			'items'=> $records,
			'page_title'=> 'List of education stages'
		];

		return view($tpl, $tpl_data);
	}

	public function newForm(Request $request)
	{
		$tpl = $this->getTpl('education_stages/new-form');
		$form = new SafeObject([
			'password'=> uniqid()
		]);
		$tpl_data = [
			'form_legend'=> 'Create new education stage',
			'form_action'=> 'create',
			'form'=> $form,
			'page_title'=> 'New Education',
			'options'=> new SafeObject([
				'stages'=> $this->getStageOptions()
			])
		];
		return view($tpl, $tpl_data);
	}

	public function updateForm(Request $request, $education_stage_id)
	{
		$item = EducationStage::select('*')->where('education_stages.id', '=', $education_stage_id)->first();
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('education_stages/update-form');
		$tpl_data = [
			'form_legend'=> 'Update education stage',
			'form_action'=> 'update',
			'form'=> $form,
			'page_title'=> 'Update Education',
			'options'=> new SafeObject([
				'stages'=> $this->getStageOptions()
			])
		];
		return view($tpl, $tpl_data);
	}

	public function create(Request $request)
	{
		$data = $request->all();
		$data['created_at'] = DT::utc();
		$data['created_by'] = 'System';
		
		$education_stage = new EducationStage();
		$education_stage->fill($data);
		$education_stage->save();

		return redirect()->action("\\".self::class."@index");
	}

	public function update(Request $request, $education_stage_id)
	{
		$data = $request->all();
		$data['updated_at'] = DT::utc();
		$data['updated_by'] = 'System';
		
		$education_stage = EducationStage::find($education_stage_id);
		if(empty($education_stage)){
			throw new \Exception("User not a education stage");
		}
		$education_stage->fill($data);
		$education_stage->save();

		return redirect()->action("\\".self::class."@updateForm", ['education_stage_id'=>$education_stage_id]);
	}

	public function deleteForm(Request $request, $education_stage_id)
	{
		$item = EducationStage::find($education_stage_id);
		if(empty($item)){
			throw new \Exception("User not a education stage");
		}
		$item = $item->toArray();
		$form = new SafeObject($item);
		$tpl = $this->getTpl('education_stages/delete-form');
		$tpl_data = [
			'form_legend'=> 'Confirm delete education stage',
			'form_action'=> 'delete',
			'form'=> $form,
			'page_title'=> 'Delete education stage'
		];
		
		return view($tpl, $tpl_data);
	}

	public function delete(Request $request, $education_stage_id)
	{
		$education_stage = EducationStage::find($education_stage_id);
		if(empty($education_stage)){
			throw new \Exception("Education Stage not found");
		}
		$education_stage->forceDelete();

		return redirect()->action("\\".self::class."@index");
	}

	protected function getStageOptions()
	{
		$opts = [
			['value'=> 'preschool', 'label'=> 'Pre-school'],
			['value'=> 'elementary', 'label'=> 'Elementary'],
			['value'=> 'highschool', 'label'=> 'High School']
		];
		return $opts;
	}
}
