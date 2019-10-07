@php
$grade_level_options = [
	['value'=> 'g1', 'label'=> 'Grade 1'],
	['value'=> 'g2', 'label'=> 'Grade 2'],
	['value'=> 'g3', 'label'=> 'Grade 3'],
	['value'=> 'g4', 'label'=> 'Grade 4']
];
@endphp
{{ csrf_field() }}
<fieldset class="uk-fieldset">
	<legend class="uk-legend">{{ $form_legend }}</legend>
	<div class="uk-margin"></div>
	<div>
			<label class="uk-form-label">Name:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="text" name="name" required value="{{ $form->name }}">
			</div>
	</div>
	<div>
		<label class="uk-form-label">&nbsp;</label>
		<div class="uk-form-controls">
			<button class="uk-button uk-button-primary" type="submit">Save</button>
			<a href="{{ action('StudentController@index') }}" class="uk-button uk-button-default">Cancel</a>
		</div>		
	</div>
</fieldset>