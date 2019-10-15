@if($form_sub_name == 'index')

<div class="uk-container">
	<a href="{{ action('TeacherController@attachSubjectsForm', ['teacher_id'=> $form->id]) }}" class="uk-button uk-button-primary" title="Add item">
		<span uk-icon="icon: plus;"></span>
	</a>
	<a href="" class="uk-button uk-button-default" title="refresh list">
		<span uk-icon="icon:refresh"></span>
	</a>
</div>


<table class="uk-table">
	<tr>
		<thead>
			<th>ID</th>
			<th>Subject</th>
			<th>Actions</th>
		</thead>
		<tbody>
			@if(count($subjects) == 0)
				<tr>
					<td colspan="3" style="text-align:center">No record found</td>
				</tr>
			@endif
			@foreach($subjects as $subject)
				<tr>
					<td>{{ $subject->id }}</td>
					<td>{{ $subject->name }}</td>
					<td>Action</td>
				</tr>
			@endforeach
		</tbody>
	</tr>
</table>

@elseif($form_sub_name == 'create')

<form  class="uk-form-stacked" action="POST">
	<fieldset class="uk-fieldset">
		<legend class="uk-legend">{{ $page_title }}</legend>
		<div class="uk-margin"></div>
		<div>
				<label class="uk-form-label">Subject:</label>
				<div class="uk-form-controls">
					<input class="uk-input" type="text" name="subjects" required>
				</div>
		</div>
		<div>
			<label class="uk-form-label">&nbsp;</label>
			<div class="uk-form-controls">
				<button class="uk-button uk-button-primary" type="submit">Save</button>
				<a href="{{ action('TeacherController@listSubjects', [$form->id]) }}" class="uk-button uk-button-default">Cancel</a>
			</div>		
		</div>
	</fieldset>
</form>

@endif