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
		<label class="uk-form-label">Category:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="text" name="category" required value="{{ $form->category }}">
			</div>
	</div>
	<div>
			<label class="uk-form-label">Education Stage:</label>
			<div class="uk-form-controls">
				<input class="uk-input" type="text" name="education_stage_id" required value="{{ $form->education_stage_id }}">
			</div>
	</div>
	<div>
		<label class="uk-form-label">&nbsp;</label>
		<div class="uk-form-controls">
			<button class="uk-button uk-button-primary" type="submit">Save</button>
			<a href="{{ action('SubjectController@index') }}" class="uk-button uk-button-default">Cancel</a>
		</div>		
	</div>
</fieldset>